<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Models\Place;
use App\Models\PlaceAllowedUsers;
use App\Models\Unity;
use App\Models\UserType;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PlaceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Place::class);
    }

    public function index()
    {
        if (Auth::user()->type === UserType::ADMIN) {
            $places = Place::sortable();
        }
        else if (Auth::user()->type === UserType::COORDINATOR) {
            $places = Place::sortable()->where('unity_id', Auth::user()->unity_id);
        }

        return View::make('admin.places.index', [
            'places' => $places->orderBy('unity_id')
                               ->orderBy('name')
                               ->simplePaginate(10),
        ]);
    }

    public function create()
    {
        $unityOptions = Unity::options();
        $userTypeOptions = UserType::options();
        $userTypeOptions = array_filter(
            $userTypeOptions,
            fn($opt) => !in_array(
                $opt['value'],
                [UserType::ADMIN->value, UserType::COORDINATOR->value]
            )
        );

        if (Request::has('back'))
            Session::flash('back', Request::get('back'));

        if (Auth::user()->type === UserType::COORDINATOR)
            $unityOptions = array_filter($unityOptions, fn($opt) => $opt['value'] === Auth::user()->unity_id);

        return View::make('admin.places.create', [
            'unityOptions' => $unityOptions,
            'userTypeOptions' => $userTypeOptions,
        ]);
    }

    public function store(PlaceRequest $request)
    {
        $data = $request->validated();

        try {
            DB::transaction(function() use (&$data) {
                $place = Place::create($data);

                foreach ($data['allowedUserTypes'] as $userType) {
                    PlaceAllowedUsers::create([
                        'place_id' => $place->id,
                        'user_type' => $userType,
                    ]);
                }
            });
        } catch (UniqueConstraintViolationException) {
            return Redirect::back()->withErrors(['name' => 'Já existe um Ambiente com esse nome nesta Unidade'])->withInput();
        }

        if (Session::has('back'))
            return Redirect::to(Session::get('back'));

        return Redirect::route('admin.places.index');
    }

    public function show(Place $place)
    {
        if (Request::has('back'))
            Session::flash('back', Request::get('back'));

        $allowedUserTypes = PlaceAllowedUsers::where('place_id', $place->id)->get(['user_type'])->map(fn($m) => $m->user_type);

        return View::make('admin.places.show', [
            'place' => $place,
            'allowedUserTypes' => $allowedUserTypes,
        ]);
    }

    public function edit(Place $place)
    {
        $allowedUserTypes = PlaceAllowedUsers::where('place_id', $place->id)->get(['user_type'])->map(fn($m) => $m->user_type->value);
        $userTypeOptions = UserType::options();
        $userTypeOptions = array_filter($userTypeOptions, fn($opt) => !in_array($opt['value'], [UserType::ADMIN->value, UserType::COORDINATOR->value]));

        return View::make('admin.places.edit', [
            'place' => $place,
            'unityOptions' => Unity::options(),
            'userTypeOptions' => $userTypeOptions,
            'allowedUserTypes' => $allowedUserTypes->toArray(),
        ]);
    }

    public function update(PlaceRequest $request, Place $place)
    {
        $data = $request->validated();

        try {
            DB::transaction(function() use (&$place, &$data) {
                $place->update($data);
                PlaceAllowedUsers::where('place_id', $place->id)->delete();

                foreach ($data['allowedUserTypes'] as $userType) {
                    PlaceAllowedUsers::create([
                        'place_id' => $place->id,
                        'user_type' => $userType,
                    ]);
                }
            });

        } catch (UniqueConstraintViolationException $err) {
            return Redirect::back()->withErrors(['name' => 'Já existe um Ambiente com esse nome nessa Unidade'])->withInput();
        }

        return Redirect::route('admin.places.show', $place->id);
    }

    public function destroy(Place $place)
    {
        $place->delete();

        if (Session::has('back'))
            return Redirect::to(Session::get('back'));

        return Redirect::route('admin.places.index');
    }

    public function batchCreate()
    {
        $user = Auth::user();

        if ($user->type === UserType::ADMIN)
            $unities = Unity::all();
        else if ($user->type === UserType::COORDINATOR)
            $unities = Unity::where('id', $user->unity_id)->get();

        $userTypeOptions = UserType::options();
        $userTypeOptions = array_filter(
            $userTypeOptions,
            fn($opt) => !in_array(
                $opt['value'],
                [UserType::ADMIN->value, UserType::COORDINATOR->value]
            )
        );

        return View::make('admin.places.batch-create', [
            'userTypeOptions' => $userTypeOptions,
            'unities' => $unities,
        ]);
    }

    public function batchStore(HttpRequest $request)
    {
        $request->validate([
            'unities' => ['required', 'array'],
        ]);

        foreach ($request->unities as $unityId) {
            for ($i = 0; $i < count($request->places ?? []); $i++) {
                $name = $request->places[$i];

                try {
                    $place = Place::create(['name' => $name, 'unity_id' => $unityId, 'qrcode' => Str::random()]);

                    foreach ($request['place' . $i . '_users'] as $userType) {
                        try {
                            PlaceAllowedUsers::create(['place_id' => $place->id, 'user_type' => $userType]);
                        } catch (\Exception) { }
                    }
                } catch(\Exception) { }
            }
        }

        return Redirect::route('admin.places.index');
    }

    protected function resourceAbilityMap()
    {
        return [
            'show' => 'view',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'update',
            'update' => 'update',
            'destroy' => 'delete',
            'batchCreate'=>'batchCreate'
        ];
    }

    protected function resourceMethodsWithoutModels()
    {
        return ['index', 'create', 'store','batchCreate'];
    }
}
