<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; // Asegurarse de importar Auth

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirigir usuarios después de iniciar sesión
     *
     * @return string
     */
    protected function redirectTo()
    {
        // Obtener el rol del usuario autenticado
        $rol = Auth::user()->rol;

        // Redirigir en función del rol
        if ($rol == 'soporte') {
            return '/soporte/dashboard'; // Redirigir al dashboard de soporte
        } elseif ($rol == 'cliente') {
            return '/cliente/dashboard'; // Redirigir al dashboard de cliente
        } else {
            return '/home'; // Redirigir al home por defecto
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}

