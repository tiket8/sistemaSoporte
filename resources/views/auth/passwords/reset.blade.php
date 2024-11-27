@extends('layouts.app')

@section('content')
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Títulos -->
        <h2 class="active"> Restablecer Contraseña </h2>

        <!-- Formulario -->
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email -->
            <input id="email" type="email" name="email" placeholder="Correo Electrónico"
                   class="@error('email') is-invalid @enderror"
                   value="{{ $email ?? old('email') }}" required autofocus>
            @error('email')
            <span class="invalid-feedback" style="color: red; font-size: 12px;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <!-- Contraseña -->
            <input id="password" type="password" name="password" placeholder="Nueva Contraseña"
                   class="@error('password') is-invalid @enderror" required>
            @error('password')
            <span class="invalid-feedback" style="color: red; font-size: 12px;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <!-- Confirmar Contraseña -->
            <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirmar Contraseña" required>

            <!-- Botón para enviar -->
            <input type="submit" class="fadeIn fourth" value="Restablecer Contraseña">
        </form>

        <!-- Footer -->
        <div id="formFooter">
            <a class="underlineHover" href="{{ route('login') }}">Volver al Inicio de Sesión</a>
        </div>
    </div>
</div>
@endsection
