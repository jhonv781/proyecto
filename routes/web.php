<?php

use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Admin\EstudianteController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\RestauranteController;
use App\Http\Controllers\Admin\VehiculoController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});
Route::prefix('admin')->group(function () {
    Route::resource('block', BlockController::class)
        ->only(['index', 'store', 'update', 'destroy'])
        ->names('admin.block');
    Route::resource('estudiante', EstudianteController::class)
        ->only(['index', 'store', 'update', 'destroy'])
        ->names('admin.estudiante');
    Route::resource('producto', ProductoController::class)
        ->only(['index', 'store', 'update', 'destroy'])
        ->names('admin.producto');
    Route::resource('restaurante', RestauranteController::class)
        ->only(['index', 'store', 'update', 'destroy'])
        ->names('admin.restaurante');
    Route::resource('vehiculo', VehiculoController::class)
        ->only(['index', 'store', 'update', 'destroy'])
        ->names('admin.vehiculo');
});

require __DIR__ . '/auth.php';
