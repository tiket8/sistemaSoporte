<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
    
    <!-- Agrega Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Navbar -->
    @auth
    <x-navbar />
    @endauth

    <!-- Contenido -->
    <main>
        @yield('content')
    </main>
</body>
</html>
