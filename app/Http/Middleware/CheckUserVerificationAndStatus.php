<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserVerificationAndStatus
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Verifica si el usuario no ha verificado el correo
            if (!$user->hasVerifiedEmail()) {
               Auth::logout();
                return redirect()->route('verification.notice')
                    ->withErrors(['email' => 'Debes verificar tu correo electrónico antes de acceder.']);
            }

            //- Verifica si el estado del usuario está inactivo
            if (!$user->estado) {
                Auth::logout();
                return redirect()->route('login')
                    ->withErrors(['account_inactive' => 'Tu cuenta está inactiva. Contacta al administrador.']);
            }
        }

        return $next($request);
    }
}
