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
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el usuario tiene el rol requerido
        if ($user->rol !== $role) {
            abort(403, 'Acceso denegado. No tienes el rol adecuado.');
        }

        // Permitir continuar con la solicitud
        return $next($request);
    }
}
