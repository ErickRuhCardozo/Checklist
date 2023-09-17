<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScanRequest;
use App\Models\Place;
use App\Models\PlaceAllowedUsers;
use App\Models\Scan;
use App\Models\ScanTask;
use App\Models\Task;
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

        // TODO: Needs Refactoring. Create separated methods to do each check.
        if ($request->has('qrcode')) {
            // Try to find a Place with the qrcode.
            // If not found or the place belongs to a Unity different that the current user's Unity,
            // redirect back with errors
            $place = Place::where('qrcode', $request->get('qrcode'))->first();

            if ($place === null) {
                return Redirect::back()->withErrors(['error' => 'Nenhum local com esse QRCode encontrado. Tente Novamente.']);
            } else if ($place->unity->id !== Auth::user()->unity->id) {
                return Redirect::back()->withErrors(['error' => 'Esse ambiente não pertence à sua Unidade.']);
            }

            // If the Place was found and it belongs to the same Unity of the current User,
            // check if this place was already checked in the current Checklist.
            // If so, redirect to the scan's info.
            // TODO: Clean up this mess
            if (Scan::where('checklist_id', Auth::user()->current_checklist_id)->where('place_id', $place->id)->count() > 0)
                return Redirect::route('employee.scans.show', Scan::where('checklist_id', Auth::user()->current_checklist_id)->where('place_id', $place->id)->first()->id);

            // If found, check if the current user is allowed to check in the Place. If not, return back with errors
            $allowedUsers = PlaceAllowedUsers::where('place_id', $place->id)->get()->map(fn($model) => $model->user_type->value)->toArray();

            if (!in_array(Auth::user()->type->value, $allowedUsers))
                return Redirect::back()->withErrors(['error' => 'Você não está autorizado a checar esse Ambiente.']);

            // If the Place was found and the current user is allowed to check,
            // load the Place's Tasks with the same period as the work_period of the current User
            $tasks = Task::where('place_id', $place->id)->where('period', Auth::user()->work_period)->get();
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
}
