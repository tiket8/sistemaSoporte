<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->estado) {
            Auth::logout();
            return redirect('/login')->with('error', 'Tu cuenta está desactivada. Contacta al administrador.');
        }

        return $next($request);
    }
}
