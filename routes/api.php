<?php

use App\Http\Controllers\Api\BlockApiController;
use App\Http\Controllers\Api\EstudianteApiController;
use App\Http\Controllers\Api\ProductoApiController;
use App\Http\Controllers\Api\RestauranteApiController;
use App\Http\Controllers\Api\VehiculoApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// 🚀 Rutas de Productos API
Route::apiResource('productos', ProductoApiController::class);
Route::apiResource('estudiantes', EstudianteApiController::class);
Route::apiResource('block', BlockApiController::class);
Route::apiResource('restaurante', RestauranteApiController::class);
Route::apiResource('vehiculo', VehiculoApiController::class);
