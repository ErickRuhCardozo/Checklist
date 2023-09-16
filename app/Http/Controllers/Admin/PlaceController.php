<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Models\Place;
use App\Models\Unity;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class PlaceController extends Controller
{
    public function index()
    {
        return View::make('admin.places.index', [
            'places' => Place::all()
        ]);
    }

    public function create()
    {
        if (Request::has('back'))
            Session::flash('back', Request::get('back'));

        return View::make('admin.places.create', [
            'unityOptions' => Unity::options()
        ]);
    }

    public function store(PlaceRequest $request)
    {
        try {
            Place::create($request->validated());
        } catch (UniqueConstraintViolationException $err) {
            return Redirect::back()->withErrors(['name' => 'Já existe um Ambiente com esse nome nesta Unidade'])->withInput();
        }

        if (Session::has('back'))
            return Redirect::to(Session::get('back'));

        return Redirect::route('places.index');
    }

    public function show(Place $place)
    {
        if (Request::has('back'))
            Session::flash('back', Request::get('back'));

        return View::make('admin.places.show', [
            'place' => $place
        ]);
    }

    public function edit(Place $place)
    {
        return View::make('admin.places.edit', [
            'place' => $place,
            'unityOptions' => Unity::options()
        ]);
    }

    public function update(PlaceRequest $request, Place $place)
    {
        try {
            $place->update($request->validated());
        } catch (UniqueConstraintViolationException $err) {
            return Redirect::back()->withErrors(['name' => 'Já existe um Ambiente com esse nome nessa Unidade'])->withInput();
        }

        return Redirect::route('places.show', $place->id);
    }

    public function destroy(Place $place)
    {
        $place->delete();

        if (Session::has('back'))
            return Redirect::to(Session::get('back'));

        return Redirect::route('places.index');
    }
}
