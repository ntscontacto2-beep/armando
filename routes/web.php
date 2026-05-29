<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\TwoFactorController; 
use App\Http\Middleware\TwoFactorMiddleware;   
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GraficasController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VendedorController; // <--- 1. ESTO FALTABA

/*
|--------------------------------------------------------------------------
| 1. Rutas Públicas (LA RAÍZ)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| 2. Rutas de Verificación 2FA (Solo Auth, SIN Middleware 2FA)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('verify', [TwoFactorController::class, 'index'])->name('verify.index');
    Route::post('verify', [TwoFactorController::class, 'store'])->name('verify.store');
    Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
});

/*
|--------------------------------------------------------------------------
| 3. ZONA SEGURA (Requiere Login + Código 2FA Verificado)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', TwoFactorMiddleware::class])->group(function () {

    // --- DASHBOARD ---
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // --- GESTIÓN DE VENDEDORES (NUEVO - ESTO FALTABA) ---
    Route::resource('vendedores', VendedorController::class);

    // --- GESTIÓN DE LOCALES (CRUD) ---
    Route::get('/locales/crear', [LocalController::class, 'create'])->name('locales.create');
    Route::post('/locales', [LocalController::class, 'store'])->name('locales.store');
    Route::get('/locales/{id}/editar', [LocalController::class, 'edit'])->name('locales.edit');
    Route::put('/locales/{id}', [LocalController::class, 'update'])->name('locales.update');
    Route::delete('/locales/{id}', [LocalController::class, 'destroy'])->name('locales.destroy');
    
    // --- REPORTES Y EXPORTACIÓN ---
    Route::get('/locales/reporte-pdf', [LocalController::class, 'generarPDF'])->name('locales.pdf');
    Route::get('/locales/reporte-excel', [LocalController::class, 'generarExcel'])->name('locales.excel');

    // --- PERFIL DE USUARIO ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- INVENTARIO ---
    Route::get('/inventario', [ProductoController::class, 'index'])->name('productos.index');
    Route::post('/inventario', [ProductoController::class, 'store'])->name('productos.store');
    Route::post('/inventario/{id}/stock', [ProductoController::class, 'actualizarStock'])->name('productos.stock');
});

/*
|--------------------------------------------------------------------------
| 4. Rutas del Menú (Alias Públicos / Visualización)
|--------------------------------------------------------------------------
*/
Route::get('/locales', [HomeController::class, 'index'])->name('locales.index');
Route::get('/rutas', [HomeController::class, 'rutas'])->name('rutas.index');     // <-- CAMBIADO
Route::get('/historia', [HomeController::class, 'historia'])->name('historia.index'); // <-- CAMBIADO

require __DIR__.'/auth.php';