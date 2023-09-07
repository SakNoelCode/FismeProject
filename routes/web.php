<?php

use App\Http\Controllers\Asesor\ProyectoAsesorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\Tesista\ProyectoTesistaController;
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

//Rutas para el welcome
Route::get('/mesa-de-partes', function () {
    return view('mesa-de-partes');
});


//Rutas para la secretaría:
Route::group(['middleware' => ['auth', 'role:secretaria']], function () {
    Route::resources([
        'proyectos' => ProyectoController::class
    ]);

    Route::get('/cambiar-estado/{proyecto}',[ProyectoController::class,'cambiarEstado'])->name('proyecto.cambiarEstado');
    Route::patch('/cambiar-estado/{proyecto}',[ProyectoController::class,'updateEstado'])->name('proyecto.updateEstado');
    Route::patch('/cambiar-etapa/{proyecto}',[ProyectoController::class,'updateEtapa'])->name('proyecto.updateEtapa');
    Route::get('/add-resolucion/{proyecto}',[ProyectoController::class,'addResolucion'])->name('proyecto.addResolucion');
    Route::post('/add-resolucion/{proyecto}',[ProyectoController::class,'storeAddResolucion'])->name('proyecto.storeAddResolucion');
    Route::post('/proyectos/{id}',[ProyectoController::class,'downloadResolucion'])->name('resolucion.download');
    Route::post('/proyectos/deleteResolucion/{id}',[ProyectoController::class,'destroyResolucion'])->name('Proyecto.resolucion.destroy');
    //Route::get('/')
});

//Rutas para tesista
Route::group(['middleware' => ['auth', 'role:tesista']], function () {
    Route::resource('proyectoTesista',ProyectoTesistaController::class)->only(['index']);

    Route::get('/ver-estado/{proyecto}',[ProyectoTesistaController::class,'verEstado'])->name('proyectoTesista.verEstado');
    Route::get('/proyectoTesista/createActividad/{proyecto}',[ProyectoTesistaController::class,'crearActividad'])->name('proyectoTesista.crearActividad');
    Route::post('/proyectoTesista/createActividad/{proyecto}',[ProyectoTesistaController::class,'storeActividad'])->name('proyectoTesista.storeActividad');
    Route::get('/proyectoTesista/editActividad/{proyecto}/{actividad}',[ProyectoTesistaController::class,'editActividad'])->name('proyectoTesista.editActividad');
    Route::patch('/proyectoTesista/editActividad/{proyecto}{actividad}',[ProyectoTesistaController::class,'updateActividad'])->name('proyectoTesista.updateActividad');
    Route::post('/proyectoTesistaUpdateFecha/{proyecto}',[ProyectoTesistaController::class,'updateFecha'])->name('proyectoTesista.updateFecha');
    Route::post('/proyectoTesista/{id}',[ProyectoController::class,'downloadResolucion'])->name('resolucionTesista.download');
});

//Rutas para asesor
Route::group(['middleware' => ['auth', 'role:asesor']], function () {
    Route::resource('proyectoAsesor',ProyectoAsesorController::class)->only(['index']);

    Route::get('/proyectoAsesor/ver-estado/{proyecto}',[ProyectoAsesorController::class,'verEstado'])->name('proyectoAsesor.verEstado');
    Route::post('/proyectoAsesor/{id}',[ProyectoController::class,'downloadResolucion'])->name('resolucionAsesor.download');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
