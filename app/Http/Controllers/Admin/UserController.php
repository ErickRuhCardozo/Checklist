<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Unity;
use App\Models\UserType;
use App\Models\WorkPeriod;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $users = User::sortable()->where('id', '!=', Auth::id());

        if (Auth::user()->type == UserType::COORDINATOR) {
            $users = $users->where('unity_id', Auth::user()->unity_id);
        }

        return View::make('admin.users.index', [
            'users' => $users->orderBy('unity_id')
                             ->orderBy('type')
                             ->simplePaginate(10),
        ]);
    }

    public function create(Request $request)
    {
        if ($request->has('back'))
            Session::flash('back', ClientRequest::get('back'));

        $unityOptions = Unity::options();
        $userTypeOptions = UserType::options();

        if (Auth::user()->type === UserType::COORDINATOR) {
            $unityOptions = array_filter($unityOptions, fn($opt) => $opt['value'] === Auth::user()->unity_id);
            $userTypeOptions = array_filter(
                $userTypeOptions,
                fn($opt) => !in_array(
                    $opt['value'],
                    [UserType::ADMIN->value, UserType::COORDINATOR->value]
                )
            );
        }

        return View::make('admin.users.create', [
            'userTypeOptions' => $userTypeOptions,
            'workPeriodOptions' => WorkPeriod::options(),
            'unityOptions' => $unityOptions,
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        try {
            User::create($request->validated());
        } catch (UniqueConstraintViolationException) {
            return Redirect::back()->withErrors(['name' => 'Já existe um funcionário com mesmo nome na mesma Unidade'])->withInput();
        }

        if (Session::has('back'))
            return Redirect::to(Session::get('back'));

        return Redirect::route('admin.users.index');
    }

    public function show(Request $request, User $user)
    {
        if ($request->has('back'))
            Session::flash('back', FacadesRequest::get('back'));

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
        return Redirect::route('admin.users.show', $user->id);
    }

    public function destroy(User $user)
    {
        $user->delete();

        if (Session::has('back'))
            return Redirect::to(Session::get('back'));

        return Redirect::route('admin.users.index');
    }
}
