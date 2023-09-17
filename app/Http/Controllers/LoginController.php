<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class LoginController extends Controller
{
    public function index()
    {
        return View::make('login.index', [
            'userOptions' => User::options(),
        ]);
    }

    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'numeric'],
            'password' => ['required']
        ]);

        $user = User::find($data['user_id']);

        if (!Hash::check($data['password'], $user->password))
            return Redirect::back()->withErrors(['password' => 'Senha Incorreta'])->withInput();

        Auth::login($user);
        Session::regenerate();
        return $this->redirectUser($user);
    }

    private function redirectUser(User $user)
    {
        return match ($user->type) {
            UserType::ADMIN => Redirect::route('admin.home'),
            default => Redirect::route('employee.checklists.index')
        };
    }
}
