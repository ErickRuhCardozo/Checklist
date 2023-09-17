<?php

namespace App\Http\Middleware;

use App\Models\UserType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_if(!Auth::check() || Auth::user()->type != UserType::ADMIN, Response::HTTP_FORBIDDEN, 'Você não é um usuário Administrador');
        return $next($request);
    }
}
