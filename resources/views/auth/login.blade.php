<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Sistema de Soporte :: INAAPS</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Títulos -->
            <h2 class="active"> Iniciar Sesión</h2>
            

            <!-- Icono -->
            <div class="fadeIn first">
                <img src="{{ asset('img/icon.png') }}" id="icon" alt="User Icon" />
            </div>

            <!-- Formulario -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="email" id="email" class="fadeIn second" name="email" placeholder="Correo Electrónico" required>
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="Contraseña" required>
                <input type="submit" class="fadeIn fourth" value="Iniciar Sesión">
            </form>
            <h2 class="inactive underlineHover">Registrate Aqui</h2>
            <!-- Footer -->
            <div id="formFooter">
                <a class="underlineHover" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
            </div>
        </div>
    </div>
</body>
</html>
