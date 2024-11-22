<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Manejar una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Verifica si el usuario tiene el rol adecuado
        $user = Auth::user();
        if ($user->rol !== $role) {
            return redirect('/home'); // Redirigir si no tiene el rol adecuado
        }

        return $next($request);
    }
}
