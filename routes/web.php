<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SoporteController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrioridadController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubCategoriaController;

// Rutas de autenticación con verificación habilitada
Auth::routes(['verify' => true]);

// Ruta raíz que dirige al login o redirige según el rol
Route::get('/', function () {
    if (Auth::check()) {
        switch (Auth::user()->rol) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'soporte':
                return redirect()->route('soporte.dashboard');
            case 'cliente':
                return redirect()->route('cliente.dashboard');
        }
    }
    return redirect()->route('login');
})->name('home');

// Rutas de login y logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Grupo de rutas autenticadas
Route::middleware(['auth'])->group(function () {

    // Rutas para administradores
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // Mantenimiento de usuarios
        Route::resource('users', UserController::class)->only(['index', 'edit', 'update']);
        Route::post('users/{id}/activate', [UserController::class, 'activate'])->name('users.activate');
        Route::post('users/{id}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');

        // Mantenimiento de prioridades
        Route::get('/prioridad', [PrioridadController::class, 'index'])->name('prioridad.index');
        Route::post('/prioridad/store', [PrioridadController::class, 'store'])->name('prioridad.store');
        Route::delete('/prioridad/{id}', [PrioridadController::class, 'destroy'])->name('prioridad.destroy');
        Route::get('/prioridad/{id}/edit', [PrioridadController::class, 'edit'])->name('prioridad.edit');

        // Mantenimiento de categorías
        Route::resource('categoria', CategoriaController::class);
        Route::post('categoria/{id}/restore', [CategoriaController::class, 'restore'])->name('categoria.restore');

        // Mantenimiento de subcategorías
        Route::resource('subcategoria', SubCategoriaController::class);
        Route::post('subcategoria/{id}/restore', [SubCategoriaController::class, 'restore'])->name('subcategoria.restore');
    });

    // Rutas para soporte
    Route::prefix('soporte')->group(function () {
        Route::get('/dashboard', [SoporteController::class, 'index'])->name('soporte.dashboard');

        // Crear tickets
        Route::get('/tickets/crear', [TicketController::class, 'create'])->name('soporte.tickets.create');
        Route::post('/tickets', [TicketController::class, 'store'])->name('soporte.tickets.store');

        // Consultar tickets
        Route::get('/tickets', [TicketController::class, 'index'])->name('soporte.tickets.index');
        Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('soporte.tickets.show');
    });

    // Rutas para clientes
    Route::prefix('cliente')->group(function () {
        Route::get('/dashboard', [ClienteController::class, 'index'])->name('cliente.dashboard');

        // Crear tickets
        Route::get('/tickets/crear', [TicketController::class, 'create'])->name('cliente.tickets.create');
        Route::post('/tickets', [TicketController::class, 'store'])->name('cliente.tickets.store');

        // Consultar tickets
        Route::get('/tickets', [TicketController::class, 'index'])->name('cliente.tickets.index');
        Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('cliente.tickets.show');
    });

    // Rutas de tickets
    Route::prefix('tickets')->group(function () {
        Route::get('/', [TicketController::class, 'index'])->name('tickets.index');
        Route::get('/create', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('/', [TicketController::class, 'store'])->name('tickets.store');
        Route::get('/{id}', [TicketController::class, 'show'])->name('tickets.show');
    });

    // Rutas de verificación de correo electrónico
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware(['signed'])
        ->name('verification.verify');
    Route::post('/email/resend', [VerificationController::class, 'resend'])
        ->name('verification.resend');

    // Rutas adicionales
    Route::get('/api/subcategorias/{catId}', [SubCategoriaController::class, 'getByCategory']);
});
