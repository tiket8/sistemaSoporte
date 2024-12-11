<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Las capas de middleware globales de la aplicación.
     *
     * Estos middleware son ejecutados durante cada solicitud a tu aplicación.
     *
     * @var array
     */
    protected $middleware = [
        // Middleware que maneja la confiabilidad del proxy
        \App\Http\Middleware\TrustProxies::class,

        // Middleware para detectar la solicitud HTTP en tiempo real
        \Illuminate\Http\Middleware\HandleCors::class,

        // Convertir cadenas vacías a null
        \App\Http\Middleware\TrimStrings::class,

        // Elimina cualquier barra invertida adicional de los campos de la solicitud
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * Los grupos de middleware para la aplicación.
     *
     * @var array
     */
    protected $middlewareGroups = [
        // Middleware para el frontend
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // Middleware de autenticación de tokens de sesión para evitar conflictos
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        // Middleware para el API
        'api' => [
            'throttle:api', // Limitar las solicitudes a la API
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * El middleware de rutas de la aplicación.
     *
     * Estos middleware se pueden asignar a grupos de rutas o usarse individualmente.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class, // Verifica la autenticación del usuario
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class, // Usa "can" para políticas y gates
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class, // Redirige si ya está autenticado
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class, // Solicita confirmación de la contraseña
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class, // Valida las URLs firmadas
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class, // Limita las solicitudes por tiempo
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class, // Verifica que el correo esté verificado
        'active' => \App\Http\Middleware\CheckActive::class,
    ];

    /**
     * Alias de middleware para configuraciones personalizadas y Spatie.
     *
     * @var array
     */
    protected $middlewareAliases = [
        'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class, // Middleware para roles
        'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class, // Middleware para permisos
        'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class, // Middleware combinado
    ];
}