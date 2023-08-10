<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyectoController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','role:tesista|secretaria|asesor'])->name('dashboard');

//Rutas para la secretaría:
Route::group(['middleware' => ['auth', 'role:secretaria']], function () {
    Route::resources([
        'proyectos' => ProyectoController::class
    ]);

    Route::get('/cambiar-estado/{proyecto}',[ProyectoController::class,'cambiarEstado'])->name('proyecto.cambiarEstado');
    Route::patch('/cambiar-estado/{proyecto}',[ProyectoController::class,'updateEstado'])->name('proyecto.updateEstado');
    Route::patch('/cambiar-etapa/{proyecto}',[ProyectoController::class,'updateEtapa'])->name('proyecto.updateEtapa');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
