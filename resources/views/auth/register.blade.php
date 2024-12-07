@extends('layouts.app')

@section('content')
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Título -->
        <h2 class="active"> Registro de Usuario </h2>

        <!-- Formulario -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre -->
            <input id="name" type="text" name="name" placeholder="Nombre" 
                   class="fadeIn second @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
            <span class="invalid-feedback" style="color: red; font-size: 12px;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <!-- Apellido -->
            <input id="apellido" type="text" name="apellido" placeholder="Apellido" 
                   class="fadeIn second @error('apellido') is-invalid @enderror" value="{{ old('apellido') }}" required>
            @error('apellido')
            <span class="invalid-feedback" style="color: red; font-size: 12px;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <!-- Correo Electrónico -->
            <input id="email" type="email" name="email" placeholder="Correo Electrónico" 
                   class="fadeIn second @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
            <span class="invalid-feedback" style="color: red; font-size: 12px;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <!-- Teléfono -->
            <input id="telefono" type="text" name="telefono" placeholder="Teléfono (Opcional)" 
                   class="fadeIn second @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
            @error('telefono')
            <span class="invalid-feedback" style="color: red; font-size: 12px;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <!-- Número de Empleado -->
            <input id="numero_empleado" type="text" name="numero_empleado" placeholder="Número de Empleado (Opcional)" 
                   class="fadeIn second @error('numero_empleado') is-invalid @enderror" value="{{ old('numero_empleado') }}">
            @error('numero_empleado')
            <span class="invalid-feedback" style="color: red; font-size: 12px;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <!-- Contraseña -->
            <input id="password" type="password" name="password" placeholder="Contraseña" 
                   class="fadeIn second @error('password') is-invalid @enderror" required>
            @error('password')
            <span class="invalid-feedback" style="color: red; font-size: 12px;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <!-- Confirmar Contraseña -->
            <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirmar Contraseña" 
                   class="fadeIn second" required>

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
