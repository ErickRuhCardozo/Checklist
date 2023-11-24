<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\Unity;
use App\Models\UserType;
use App\Models\WorkPeriod;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::sortable();

        if (Auth::user()->type === UserType::COORDINATOR)
            $tasks = $tasks->join('places', 'tasks.place_id', '=', 'places.id')
                           ->where('places.unity_id', Auth::user()->unity_id)
                           ->select('tasks.*');

        return View::make('admin.tasks.index', [
            'tasks' => $tasks->orderBy('place_id')
                             ->orderBy('title')
                             ->orderBy('period')
                             ->simplePaginate(10)
        ]);
    }

    public function create()
    {
        if (FacadesRequest::has('back'))
            Session::flash('back', FacadesRequest::get('back'));

        if (Auth::user()->type === UserType::ADMIN)
            $unities = Unity::all();
        else if (Auth::user()->type === UserType::COORDINATOR)
            $unities = Unity::where('id', Auth::user()->unity_id)->get();

        return View::make('admin.tasks.create', [
            'workPeriodOptions' => WorkPeriod::options(),
            'unities' => $unities,
        ]);
    }

    public function store(TaskRequest $request)
    {
        try {
            Task::create($request->validated());
        } catch (UniqueConstraintViolationException) {
            return Redirect::back()->withErrors(['title' => 'Já existe uma tarefa com esse nome, no mesmo turno neste Ambiente'])->withInput();
        }

        if (Session::has('back'))
            return Redirect::to(Session::get('back'));

        return Redirect::route('admin.tasks.index');
    }

    public function show(Task $task)
    {
        if (FacadesRequest::has('back'))
            Session::flash('back', FacadesRequest::get('back'));

        return View::make('admin.tasks.show', [
            'task' => $task
        ]);
    }

    public function edit(Task $task)
    {
        if (FacadesRequest::has('back'))
            Session::flash('back', FacadesRequest::get('back'));

        if (Auth::user()->type === UserType::ADMIN)
            $unities = Unity::all();
        else if (Auth::user()->type === UserType::COORDINATOR)
            $unities = Unity::where('id', Auth::user()->unity_id)->get();

        return View::make('admin.tasks.edit', [
            'task' => $task,
            'unities' => $unities,
            'workPeriodOptions' => WorkPeriod::options(),
        ]);
    }

    public function update(TaskRequest $request, Task $task)
    {
        try {
            $task->update($request->validated());
        } catch (UniqueConstraintViolationException) {
            return Redirect::back()->withErrors(['title' => 'Já existe uma tarefa com esse nome, no mesmo turno neste Ambiente'])->withInput();
        }

        if (Session::has('back'))
            return Redirect::to(Session::get('back'));

        return Redirect::route('admin.tasks.show', $task->id);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        if (Session::has('back'))
            return Redirect::to(Session::get('back'));

        return Redirect::route('admin.tasks.index');
    }

    public function batchCreate()
    {
        $user = Auth::user();

        if ($user->type === UserType::ADMIN)
            $unities = Unity::all();
        else if ($user->type === UserType::COORDINATOR)
            $unities = Unity::where('id', $user->unity_id)->get();

        return View::make('admin.tasks.batch-create', [
            'periodOptions' => WorkPeriod::options(),
            'unities' => $unities,
        ]);
    }

    public function batchStore(Request $request)
    {
        $data = $request->validate([
            'places' => ['required', 'array'],
            'titles' => ['required', 'array'],
            'periods' => ['required', 'array'],
        ]);

        foreach ($data['places'] as $placeId) {
            for ($i = 0; $i < count($data['titles']); $i++) {
                $title = $data['titles'][$i];
                $period = $data['periods'][$i];

                try {
                    Task::create([
                        'place_id' => $placeId,
                        'title' => $title,
                        'period' => $period
                    ]);
                } catch (\Exception) {
                }
            }
        }

        return Redirect::route('admin.tasks.index');
    }
}
