<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScanRequest;
use App\Models\Place;
use App\Models\PlaceAllowedUsers;
use App\Models\Scan;
use App\Models\ScanTask;
use App\Models\Task;
use App\Models\UserType;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ScanController extends Controller
{
    public function create(Request $request)
    {
        $place = null;
        $tasks = [];

        if ($request->has('qrcode')) {
            $qrcode = $request->get('qrcode');
            $user = Auth::user();

            if (!$this->isValidPlace($qrcode, $user->id, $error))
                return Redirect::back()->withErrors(['error' => $error]);

            if ($this->isPlaceAlreadyScanned($place, $user->current_checklist_id, $scan))
               return Redirect::route('employee.scans.show', $scan->id);

            if (!$this->isUserAllowedToCheckPlace($place, $user->type))
                return Redirect::back()->withErrors(['error' => 'Você não está autorizado a checar esse Ambiente.']);

            $tasks = Task::where('place_id', $place->id)
                         ->where('period', $user->work_period)
                         ->get();
        }

        return View::make('employee.scans.create', [
            'place' => $place,
            'tasks' => $tasks,
        ]);
    }

    public function store(ScanRequest $request)
    {
        $data = $request->validated();
        $scan = null;

        try {
            DB::transaction(function() use (&$data, &$scan) {
                $scan = Scan::create($data);

                foreach ($data['tasks'] ?? [] as $task) {
                    ScanTask::create([
                        'scan_id' => $scan->id,
                        'task_id' => $task
                    ]);
                }
            });

            if ($scan->checklist->scans()->count() == Auth::user()->allowedPlacesCount()) {
                Auth::user()->update(['current_checklist_id' => null]);
                $scan->checklist->update(['is_done' => true]);
            }

        } catch (UniqueConstraintViolationException) {
            return Redirect::back()->withErrors(['error' => 'Você já checou esse ambiente.']);
        }

        return Redirect::route('employee.checklists.show', $data['checklist_id']);
    }


    public function show(Scan $scan)
    {
        $tasks = $scan->place->tasks->where(fn($task) => $task->period->value === Auth::user()->work_period->value);
        $tasksDone = $scan->tasksDone()->map(fn($scanTask) => $scanTask->task->id)->toArray();

        return View::make('employee.scans.show', [
            'scan' => $scan,
            'tasks' => $tasks,
            'tasksDone' => $tasksDone,
        ]);
    }

    public function edit(Scan $scan)
    {
        $tasks = $scan->place->tasks->where(fn($task) => $task->period->value === Auth::user()->work_period->value);
        $tasksDone = $scan->tasksDone()->map(fn($scanTask) => $scanTask->task->id)->toArray();

        return View::make('employee.scans.edit', [
            'scan' => $scan,
            'tasks' => $tasks,
            'tasksDone' => $tasksDone,
        ]);
    }

    public function update(ScanRequest $request, Scan $scan)
    {
        $data = $request->validated();

        DB::transaction(function() use(&$scan, &$data) {
            $scan->update($data);
            $scan->tasksDone()->each(fn($task) => $task->delete());

            foreach ($data['tasks'] ?? [] as $task) {
                ScanTask::create([
                    'scan_id' => $scan->id,
                    'task_id' => $task
                ]);
            }

            $scan->checklist->touch();
        });

        return Redirect::route('employee.scans.show', $scan->id);
    }

    /**
     * Check if the $qrcode belongs to a valid Place and if the Place belongs to the same Unity identified by $unityId.
     * @param string $qrcode The QR Code
     * @param int $unityId The id of the current users's Unity
     * @param string $error The error if the Place was not found
     * @return bool true if a Place with $qrcode was found and it belongs to the same Unity as the User's.
     *              false otherwise.
     */
    private function isValidPlace(string $qrcode, int $unityId, string &$error): bool
    {
        $success = false;
        $place = Place::where('qrcode', $qrcode)->first();

        if ($place === null) {
            $error = 'Nenhum local com esse QRCode encontrado. Tente Novamente.';
        }
        else if ($place->unity_id !== $unityId) {
            $error = 'Esse ambiente não pertence à sua Unidade.';
        }
        else {
            $success = true;
        }

        return $success;
    }

    /**
     * Check if $place was already scanned in the Checklist identified by $checklistId.
     * @param Place $place The Place to check for scans.
     * @param int $checklistId The id of the Checklist to search for scans for $place.
     * @param Scan $scan Will be set to the Scan made in Place if Place was already scanned.
     * @return bool true if $place was already scanned, false otherwise.
     */
    private function isPlaceAlreadyScanned(Place $place, int $checklistId, Scan &$scan): bool
    {
        $scanCount = Scan::where('checklist_id', $checklistId)
                         ->where('place_id', $place->id)
                         ->count();

        if ($scanCount > 0) {
            $scan = Scan::where('checklist_id', $checklistId)
                        ->where('place_id', $place->id)
                        ->first();
             return true;
        }

        return false;
    }

    /**
     * Check if the user with $userType is allowed to check $place.
     * @param Place $place The Place.
     * @param App\Models\UserType $userType The user's type.
     * @return bool true if $userType is allowed to check $place, false otherwise.
     */
    private function isUserAllowedToCheckPlace(Place $place, UserType $userType): bool
    {
        $allowedUsers = PlaceAllowedUsers::where('place_id', $place->id)
                                         ->get()
                                         ->map(fn($model) => $model->user_type->value)
                                         ->toArray();

        return in_array($userType->value, $allowedUsers);
    }
}
