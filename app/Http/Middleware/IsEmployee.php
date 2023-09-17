<?php

namespace App\Http\Middleware;

use App\Models\UserType;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsEmployee
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_if(!Auth::check() || Auth::user()->type === UserType::ADMIN, Response::HTTP_FORBIDDEN, 'Você é um Administrador');
        return $next($request);
    }
}
