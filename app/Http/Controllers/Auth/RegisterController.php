<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Redirigir después del registro.
     *
     * @var string
     */
    protected $redirectTo = '/email/verify'; // Redirige a la página de verificación de correo.

    /**
     * Crear una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validador para los datos de registro.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'telefono' => ['nullable', 'string', 'max:15', 'regex:/^[0-9+\-()\s]*$/'], // Opcional, formato de teléfono válido.
            'numero_empleado' => ['nullable', 'string', 'max:20'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);
    }

    /**
     * Crear una nueva instancia de usuario después del registro válido.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
    return User::create([
        'name' => $data['name'],
        'apellido' => $data['apellido'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'telefono' => $data['telefono'] ?? null,
        'numero_empleado' => $data['numero_empleado'] ?? null,
        'rol' => 'cliente', // Valor por defecto.
        'estado' => false,  // Estado inactivo por defecto.
    ]);
}

    /**
     * Sobrescribe el registro para incluir el evento de verificación de correo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Valida los datos.
        $this->validator($request->all())->validate();

        // Crea el usuario.
        $user = $this->create($request->all());

        // Dispara el evento de registro (envío de email de verificación).
        event(new Registered($user));

        // Redirige al usuario para que verifique su correo.
        return redirect($this->redirectPath())->with('status', 'Te hemos enviado un correo para verificar tu cuenta.');
    }
}
