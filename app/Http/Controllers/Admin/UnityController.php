<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreUnityRequest;
use App\Http\Requests\UpdateUnityRequest;
use Illuminate\Database\UniqueConstraintViolationException;

class UnityController extends Controller
{
    public function index()
    {
        return View::make('admin.unities.index', [
            'unities' => Unity::all()
        ]);
    }

    public function create()
    {
        return View::make('admin.unities.create');
    }

    public function store(StoreUnityRequest $request)
    {
        Unity::create($request->validated());
        return Redirect::route('unities.index');
    }

    public function show(Unity $unity)
    {
        return View::make('admin.unities.show', [
            'unity' => $unity
        ]);
    }

    public function edit(Unity $unity)
    {
        return View::make('admin.unities.edit', [
            'unity' => $unity,
        ]);
    }

    public function update(UpdateUnityRequest $request, Unity $unity)
    {
        try {
            $unity->update($request->validated());
        } catch (UniqueConstraintViolationException $err) {
            return Redirect::back()->withErrors(['name' => 'Nome já em uso, escolha outro.'])->withInput();
        }

        return Redirect::route('unities.show', $unity->id);
    }

    public function destroy(Unity $unity)
    {
        $unity->delete();
        return Redirect::route('unities.index');
    }
}
