<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

// Rutas de autenticación
Auth::routes();

// Ruta raíz que dirige al login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Rutas protegidas para soporte
Route::middleware(['auth', 'role:soporte'])->group(function () {
    Route::get('/soporte/dashboard', [SoporteController::class, 'index'])->name('soporte.dashboard');
});

// Rutas protegidas para cliente
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/cliente/dashboard', [ClienteController::class, 'index'])->name('cliente.dashboard');
});
