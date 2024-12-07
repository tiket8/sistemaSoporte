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
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubCategoriaController;

// Rutas de autenticación
Auth::routes(['verify' => true]);

// Ruta raíz que dirige al login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('home');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Grupo de rutas autenticadas
Route::middleware(['auth'])->group(function () {
    // Rutas para administradores
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware('auth')
    ->name('admin.dashboard');

Route::get('/users', [UserController::class, 'index'])
    ->middleware('auth')
    ->name('users.index');

Route::get('/priorities', [PriorityController::class, 'index'])
    ->middleware('auth')
    ->name('priorities.index');

Route::get('/categorias', [CategoriaController::class, 'index'])
    ->middleware('auth')
    ->name('categoria.index');

Route::get('/subcategoria', [SubCategoriaController::class, 'index'])
    ->middleware('auth')
    ->name('subcategoria.index');

// Rutas para soporte
Route::get('/soporte/dashboard', [SoporteController::class, 'index'])
    ->middleware('auth')
    ->name('soporte.dashboard');

// Rutas para clientes
Route::get('/cliente/dashboard', [ClienteController::class, 'index'])
    ->middleware('auth')
    ->name('cliente.dashboard');


});

//Rutas de tikets 

Route::middleware(['auth'])->group(function () {
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
});

//ruta de categorias 


Route::resource('subcategoria', SubCategoriaController::class)->middleware('auth');
Route::resource('categoria', CategoriaController::class)->middleware('auth');
Route::post('subcategoria/{id}/restore', [SubCategoriaController::class, 'restore'])->name('subcategoria.restore');
Route::post('categoria/{id}/restore', [CategoriaController::class, 'restore'])->name('categoria.restore');




// Rutas de verificación de correo electrónico
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend'])
    ->middleware(['auth'])
    ->name('verification.resend');
