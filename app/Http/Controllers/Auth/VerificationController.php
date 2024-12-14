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
        Log::info('Determinando ruta de redirección.', ['rol' => auth()->user()->rol ?? null]);

        switch (auth()->user()->rol) {
            case 'admin':
                return route('admin.dashboard');
            case 'soporte':
                return route('soporte.dashboard');
            case 'cliente':
                return route('cliente.dashboard');
            default:
                return '/';
        }
    }

    /**
     * Constructor del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        Log::info('Instanciando VerificationController.');

        $this->middleware('auth');
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
    Log::info('Iniciando verificación de correo.', [
        'user_id' => $request->route('id'),
        'hash' => $request->route('hash'),
    ]);

    $user = auth()->user();

    if (!$user) {
        Log::error('Usuario no autenticado.');
        return abort(403, 'Usuario no autenticado.');
    }

    Log::info('Usuario autenticado.', ['user_id' => $user->id]);

    if ($user->getKey() != $request->route('id')) {
        Log::error('El ID del usuario no coincide.', [
            'expected_id' => $request->route('id'),
            'actual_id' => $user->getKey(),
        ]);
        return abort(403, 'El ID no coincide.');
    }

    if (!hash_equals(sha1($user->email), (string) $request->route('hash'))) {
        Log::error('El hash no coincide.', [
            'expected_hash' => sha1($user->email),
            'actual_hash' => $request->route('hash'),
        ]);
        return abort(403, 'El hash no coincide.');
    }

    if ($user->hasVerifiedEmail()) {
        Log::info('El correo ya fue verificado.', ['user_id' => $user->id]);
        return redirect($this->redirectPath());
    }

    $user->markEmailAsVerified();

    Log::info('Correo verificado exitosamente.', ['user_id' => $user->id]);

    return redirect($this->redirectPath())->with('verified', true);
}
}
