<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Maneja una solicitud entrante.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            // Redirige al login si no está autenticado
            return redirect('/login');
        }

        // Obtiene al usuario autenticado
        $user = Auth::user();

        // Registro en los logs para debug
        \Log::info('Middleware Role ejecutado.', [
            'user_id' => $user->id,
            'role' => $user->rol,
            'required_role' => $role,
        ]);

        // Verifica si el usuario tiene el rol requerido
        if (!$user->isRole($role)) {
            \Log::warning('Acceso denegado por rol incorrecto.', [
                'user_id' => $user->id,
                'role' => $user->rol,
                'required_role' => $role,
            ]);
            abort(403, 'Acceso denegado. No tienes el rol adecuado.');
        }

        // Continúa con la solicitud si pasa las verificaciones
        return $next($request);
    }
}
