<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Unity;
use App\Models\UserType;
use App\Models\WorkPeriod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        return View::make('admin.users.index', [
            'users' => User::simplePaginate()
        ]);
    }

    public function create()
    {
        if (Request::has('back'))
            Session::flash('back', Request::get('back'));

        return View::make('admin.users.create', [
            'userTypeOptions' => UserType::options(),
            'workPeriodOptions' => WorkPeriod::options(),
            'unityOptions' => Unity::options(),
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());

        if (Session::has('back'))
            return Redirect::to(Session::get('back'));

        return Redirect::route('admin.users.index');
    }

    public function show(User $user)
    {
        if (Request::has('back'))
            Session::flash('back', Request::get('back'));

        return View::make('admin.users.show', [
            'user' => $user,
        ]);
    }

    public function edit(User $user)
    {
        return View::make('admin.users.edit', [
            'user' => $user,
            'userTypeOptions' => UserType::options(),
            'workPeriodOptions' => WorkPeriod::options(),
            'unityOptions' => Unity::options(),

        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if ($data['password'] === null)
            unset($data['password']);

        $user->update($data);
        return Redirect::route('users.show', $user->id);
    }

    public function destroy(User $user)
    {
        $user->delete();

        if (Session::has('back'))
            return Redirect::to(Session::get('back'));

        return Redirect::route('users.index');
    }
}
