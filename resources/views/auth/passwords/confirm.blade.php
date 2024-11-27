@extends('layouts.app')

@section('content')
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Título -->
        <h2 class="active"> Confirmar Contraseña </h2>

        <!-- Mensaje de Información -->
        <p style="margin: 10px auto; color: #3b3939;">
            Por favor, confirma tu contraseña antes de continuar.
        </p>

        <!-- Formulario -->
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Contraseña -->
            <input id="password" type="password" name="password" placeholder="Contraseña"
                   class="@error('password') is-invalid @enderror" required>
            @error('password')
            <span class="invalid-feedback" style="color: red; font-size: 12px;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <!-- Botón de Confirmación -->
            <input type="submit" class="fadeIn fourth" value="Confirmar Contraseña">

            <!-- Enlace para Olvidar Contraseña -->
            @if (Route::has('password.request'))
                <div id="formFooter">
                    <a class="underlineHover" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
