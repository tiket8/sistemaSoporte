<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>INAAPS D.I. Soporte - Acceso</title>

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">

    <!-- Compilar y cargar SASS con Vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">

                <!-- Formulario de inicio de sesión -->
                <form class="sign-box" action="{{ route('login') }}" method="POST" id="login_form">
                    @csrf  <!-- Protección CSRF para formularios en Laravel -->

                    <input type="hidden" id="rol_id" name="rol_id" value="2"> <!-- Rol para el soporte, si es necesario -->

                    <!-- Avatar del Login -->
                    <div class="sign-avatar">
                        <img src="{{ asset('public/2.jpg') }}" alt="Avatar" id="imgtipo">
                    </div>

                    <header class="sign-title">Acceso Soporte</header>

                    <!-- Mostrar mensajes de error si los hay -->
                    @if ($errors->any())
                        <div class="alert alert-warning alert-icon alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <i class="font-icon font-icon-warning"></i>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Input de Correo Electrónico -->
                    <div class="form-group">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Correo Electrónico" value="{{ old('email') }}" required autofocus>
                    </div>

                    <!-- Input de Contraseña -->
                    <div class="form-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required>
                    </div>

                    <!-- Enlace para restablecer contraseña -->
                    <div class="form-group reset">
                        <a href="{{ route('password.request') }}">Recuperar Contraseña</a>
                    </div>

                    <!-- Botón de inicio de sesión -->
                    <button type="submit" class="btn btn-rounded">Acceder</button>

                </form>
            </div>
        </div>
    </div>

    <!-- Scripts compilados con Vite -->
    @vite(['resources/js/app.js'])
</body>
</html>
