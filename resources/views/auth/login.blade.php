@extends('layouts.app')

@section('content')
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Mensajes globales -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->has('account_inactive'))
            <div class="alert alert-danger">
                {{ $errors->first('account_inactive') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Títulos -->
        <h2 class="active"> Iniciar Sesión</h2>

        <!-- Icono -->
        <div class="fadeIn first">
            <img src="{{ asset('img/icon.png') }}" id="icon" alt="User Icon" />
        </div>

        <!-- Formulario -->
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <input type="email" id="email" class="fadeIn second" name="email" placeholder="Correo Electrónico" required>
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="Contraseña" required>
            <input type="submit" class="fadeIn fourth" value="Iniciar Sesión">
        </form>

        <!-- Enlace a Registro -->
        <h2 class="inactive underlineHover">
            <a href="{{ route('register') }}">Registrate Aquí</a>
        </h2>

        <!-- Footer -->
        <div id="formFooter">
            <a class="underlineHover" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</div>
@endsection
