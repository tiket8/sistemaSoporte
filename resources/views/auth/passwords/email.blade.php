@extends('layouts.app')

@section('content')
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Título -->
        <h2 class="active"> Restablecer Contraseña </h2>

        <!-- Mensaje de Éxito -->
        @if (session('status'))
            <div class="alert alert-success" role="alert" style="margin: 10px auto; width: 85%;">
                {{ session('status') }}
            </div>
        @endif

        <!-- Formulario -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <input id="email" type="email" name="email" placeholder="Correo Electrónico"
                   class="@error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required autofocus>
            @error('email')
            <span class="invalid-feedback" style="color: red; font-size: 12px;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <!-- Botón para enviar -->
            <input type="submit" class="fadeIn fourth" value="Enviar Enlace de Restablecimiento">
        </form>

        <!-- Footer -->
        <div id="formFooter">
            <a class="underlineHover" href="{{ route('login') }}">Volver al Inicio de Sesión</a>
        </div>
    </div>
</div>
@endsection
