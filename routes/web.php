<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\VisitasController;
use App\Http\Controllers\VisitasNewController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/logout', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes');
    Route::get('/clientes/detalhes/{id}', [ClientesController::class, 'showDetail'])->name('clientes.detail');
    
    Route::get('/visitas', [VisitasController::class, 'index'])->name('visitas');
    Route::get('/visitas/new-visita/{id}', [VisitasNewController::class, 'showDetail'])->name('visitas.new-visita');
    Route::get('/visitas/detalhes/{id}', [VisitasController::class, 'showDetail'])->name('visitas.detail');
});

require __DIR__.'/auth.php';
