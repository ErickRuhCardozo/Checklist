<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class SettingsController extends Controller
{
    public function index()
    {
        return View::make('admin.settings.index', [
            'user' => Auth::user()
        ]);
    }

    public function update(int $userId)
    {
        if (!empty(Request::get('password')))
            User::find($userId)->update(['password' => Request::get('password')]);

        return Redirect::route('admin.checklists.index');
    }
}
