<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckActive
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->estado) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Tu cuenta está inactiva. Contacta al administrador.']);
        }

        return $next($request);
    }
}
