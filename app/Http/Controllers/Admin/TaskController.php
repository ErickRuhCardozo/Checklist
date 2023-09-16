<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\Unity;
use App\Models\WorkPeriod;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class TaskController extends Controller
{
    public function index()
    {
        return View::make('admin.tasks.index', [
            'tasks' => Task::all()
        ]);
    }

    public function create()
    {
        if (FacadesRequest::has('back'))
            Session::flash('back', FacadesRequest::get('back'));

        return View::make('admin.tasks.create', [
            'workPeriodOptions' => WorkPeriod::options(),
            'unities' => Unity::all(),
        ]);
    }

    public function store(TaskRequest $request)
    {
        try {
            Task::create($request->validated());
        } catch (UniqueConstraintViolationException $err) {
            return Redirect::back()->withErrors(['title' => 'Já existe uma tarefa com esse nome, no mesmo turno neste Ambiente'])->withInput();
        }

        if (Session::has('back'))
            return Redirect::to(Session::get('back'));

        return Redirect::route('tasks.index');
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

        return View::make('admin.tasks.edit', [
            'task' => $task,            'workPeriodOptions' => WorkPeriod::options(),
            'unities' => Unity::all(),
            'workPeriodOptions' => WorkPeriod::options(),
        ]);
    }

    public function update(TaskRequest $request, Task $task)
    {
        try {
            $task->update($request->validated());
        } catch (UniqueConstraintViolationException $err) {
            return Redirect::back()->withErrors(['title' => 'Já existe uma tarefa com esse nome, no mesmo turno neste Ambiente'])->withInput();
        }

        if (Session::has('back'))
            return Redirect::to(Session::get('back'));

        return Redirect::route('tasks.show', $task->id);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        if (Session::has('back'))
            return Redirect::to(Session::get('back'));

        return Redirect::route('tasks.index');
    }
}
