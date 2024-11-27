@extends('layouts.app')

@section('content')
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Título -->
        <h2 class="active"> Verifica tu Correo Electrónico </h2>

        <!-- Mensaje de Verificación -->
        @if (session('resent'))
            <div class="alert alert-success" role="alert" style="margin: 10px auto; width: 85%; color: green;">
                Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
            </div>
        @endif

        <p style="margin: 10px auto; color: #3b3939;">
            Antes de continuar, por favor revisa tu correo electrónico para el enlace de verificación.
        </p>
        <p style="margin: 10px auto; color: #3b3939;">
            Si no recibiste el correo, solicita otro utilizando el siguiente botón:
        </p>

        <!-- Formulario para Reenviar Verificación -->
        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <input type="submit" class="fadeIn fourth" value="Reenviar Enlace de Verificación">
        </form>

        <!-- Footer -->
        <div id="formFooter">
            <a class="underlineHover" href="{{ route('login') }}">Volver al Inicio de Sesión</a>
        </div>
    </div>
</div>
@endsection
