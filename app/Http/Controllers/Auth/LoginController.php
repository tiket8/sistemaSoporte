<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        
        $rol = Auth::user()->rol;

        switch ($rol) {
            case 'admin':
                return '/admin/dashboard';
            case 'soporte':
                return '/soporte/dashboard';
            case 'cliente':
                return '/cliente/dashboard';
            default:
                Auth::logout();
                return '/login';
        }
        
       /* \Log::info('Usuario autenticado:', [
            'user_id' => auth()->id(),
            'roles' => auth()->user()->getRoleNames()->toArray(),
            'permissions' => auth()->user()->getAllPermissions()->pluck('name')->toArray(),
        ]);*/
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Muestra el formulario de inicio de sesión
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Asegúrate de que esta vista exista
    }

    /**
     * Sobrescribe el método login para verificar el estado de verificación del email
     */
    public function login(Request $request)
    {
        // Valida las credenciales de inicio de sesión
        $this->validateLogin($request);

        // Verifica si hay demasiados intentos fallidos de inicio de sesión
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // Intenta el inicio de sesión
        if ($this->attemptLogin($request)) {
            $user = Auth::user();

            // Registro temporal para depuración
            \Log::info('Usuario autenticado:', ['user' => $user]);

            // Verifica si el correo está verificado
            if (!$user->hasVerifiedEmail()) {
                Auth::logout(); // Cierra la sesión si no está verificado

                return redirect()->route('verification.notice')
                    ->withErrors(['email' => 'Debes verificar tu correo electrónico antes de iniciar sesión.']);
            }

            // Si todo está bien, envía la respuesta de inicio de sesión
            return $this->sendLoginResponse($request);
        }

        // Incrementa el contador de intentos fallidos
        $this->incrementLoginAttempts($request);

        // Responde con un mensaje de error en caso de fallo
        return $this->sendFailedLoginResponse($request);
    }
}
