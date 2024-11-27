@extends('layouts.app')

@section('content')
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Título -->
        <h2 class="active"> Registrarse </h2>

        <!-- Formulario -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre -->
            <input id="name" type="text" name="name" placeholder="Nombre Completo"
                   class="@error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
            @error('name')
            <span class="invalid-feedback" style="color: red; font-size: 12px;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <!-- Correo Electrónico -->
            <input id="email" type="email" name="email" placeholder="Correo Electrónico"
                   class="@error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
            <span class="invalid-feedback" style="color: red; font-size: 12px;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <!-- Contraseña -->
            <input id="password" type="password" name="password" placeholder="Contraseña"
                   class="@error('password') is-invalid @enderror" required>
            @error('password')
            <span class="invalid-feedback" style="color: red; font-size: 12px;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <!-- Confirmar Contraseña -->
            <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirmar Contraseña" required>

            <!-- Botón de Registro -->
            <input type="submit" class="fadeIn fourth" value="Registrarse">
        </form>

        <!-- Footer -->
        <div id="formFooter">
            <a class="underlineHover" href="{{ route('login') }}">¿Ya tienes una cuenta? Inicia Sesión</a>
        </div>
    </div>
</div>
@endsection
