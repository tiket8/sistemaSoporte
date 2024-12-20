<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'apellido',
        'rol',
        'numero_empleado',
        'estado',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function markEmailAsVerified()
{
    \Log::info('Verificando email para el usuario: ' . $this->email);

    if ($this->hasVerifiedEmail()) {
        return false;
    }

    $this->forceFill([
        'email_verified_at' => $this->freshTimestamp(),
    ])->save();

    \Log::info('Email verificado para el usuario: ' . $this->email);

    return true;
}
}