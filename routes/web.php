<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Auth;

// Rutas de autenticación (login, registro, restablecimiento de contraseñas)
Auth::routes(['verify' => true]);

// Ruta raíz que dirige al login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Rutas protegidas para soporte
Route::middleware(['auth', 'role:soporte', 'verified'])->group(function () {
    Route::get('/soporte/dashboard', [SoporteController::class, 'index'])->name('soporte.dashboard');
});

// Rutas protegidas para cliente
Route::middleware(['auth', 'role:cliente', 'verified'])->group(function () {
    Route::get('/cliente/dashboard', [ClienteController::class, 'index'])->name('cliente.dashboard');
});

// Rutas de verificación de correo electrónico
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend'])->middleware(['auth'])->name('verification.resend');

// Ruta de redirección después de la verificación (opcional)
Route::get('/home', function () {
    return redirect()->route('soporte.dashboard');
})->middleware(['auth', 'verified', 'role:soporte'])->name('home');
