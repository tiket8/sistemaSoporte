<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Gates por roles usando la columna `rol`
        Gate::define('access-admin', function ($user) {
            return $user->rol === 'admin';
        });

        Gate::define('access-soporte', function ($user) {
            return $user->rol === 'soporte';
        });

        Gate::define('access-cliente', function ($user) {
            return $user->rol === 'cliente';
        });
    }
}
