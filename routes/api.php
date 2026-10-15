<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\LocalApiController;

/*
|--------------------------------------------------------------------------
| API Routes - Tianguis SMX
|--------------------------------------------------------------------------
*/

// Rutas públicas de autenticación
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/two-factor/verify', [AuthApiController::class, 'verifyTwoFactor']);

// Rutas protegidas con Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::get('/user', [AuthApiController::class, 'me']);

    // Locales
    Route::get('/locales', [LocalApiController::class, 'index']);
    Route::get('/locales/categorias', [LocalApiController::class, 'categorias']);
    Route::get('/rutas', [LocalApiController::class, 'rutas']);

    // Dashboard stats
    Route::get('/dashboard', [LocalApiController::class, 'dashboard']);
});
