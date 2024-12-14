<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    use VerifiesEmails;

    /**
     * Define la ruta de redirección según el rol del usuario.
     *
     * @return string
     */
    protected function redirectPath()
        {
            $rol = auth()->user()->rol ?? null;

            return match ($rol) {
                'admin' => route('admin.dashboard'),
                'soporte' => route('soporte.dashboard'),
                'cliente' => route('cliente.dashboard'),
                default => '/',
            };
        }
    /**
     * Constructor del controlador.
     *
     * @return void
     */
    public function __construct()
{
    
    $this->middleware('signed')->only('verify');
    $this->middleware('throttle:6,1')->only('verify', 'resend');
}

    /**
     * Sobrescribir el método de verificación para agregar logs.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function verify(Request $request)
    {
        $userId = $request->route('id');
        $hash = $request->route('hash');
    
        $user = \App\Models\User::find($userId); 
    
        if (!$user || !hash_equals(sha1($user->email), $hash)) {
            return abort(403, 'El enlace de verificación es inválido o ha expirado.');
        }
    
        if ($user->hasVerifiedEmail()) {
            return redirect('/login')->with('message', 'El correo ya fue verificado.');
        }
    
        $user->markEmailAsVerified();
        return redirect('/login')->with('message', 'Correo verificado exitosamente. Ahora puedes iniciar sesión.');
    }

    public function show(Request $request)
{
    $user = Auth::user();

    // Verificar si el usuario está autenticado
    if (!$user) {
        return redirect('/login')->withErrors(['error' => 'Debes iniciar sesión para acceder a esta página.']);
    }

    // Si el correo ya está verificado, redirige a la ruta correspondiente
    if ($user->hasVerifiedEmail()) {
        return redirect($this->redirectPath())->with('message', 'El correo ya ha sido verificado.');
    }

    // Renderiza la vista de notificación para verificar el correo
    return view('auth.verify-email');
}
}
