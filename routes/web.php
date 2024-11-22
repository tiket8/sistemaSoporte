<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:soporte'])->group(function () {
    Route::get('/soporte/dashboard', [SoporteController::class, 'index'])->name('soporte.dashboard');
});

Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/cliente/dashboard', [ClienteController::class, 'index'])->name('cliente.dashboard');
});

