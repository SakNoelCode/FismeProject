<?php

use App\Http\Controllers\Admin\EmpresaController;
use App\Http\Controllers\Admin\TesistaController;
use App\Http\Controllers\Asesor\ProyectoAsesorController;
use App\Http\Controllers\ExpedienteController;
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

Route::view('/','welcome')->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:tesista|secretaria|asesor|director'])->name('dashboard');

//Rutas para el Home
Route::view('/mesa-de-partes', 'mesa-de-partes')->name('mesa-de-partes');

Route::view('/solicitud-practicas', 'solicitud-practicas')->name('solicitud-practicas');

Route::resource('expedientes',ExpedienteController::class);


//Rutas para la secretaría:
Route::group(['middleware' => ['auth', 'role:secretaria']], function () {
    Route::resources([
        'proyectos' => ProyectoController::class,
    ]);

    Route::get('/cambiar-estado/{proyecto}', [ProyectoController::class, 'cambiarEstado'])->name('proyecto.cambiarEstado');
    Route::patch('/cambiar-estado/{proyecto}', [ProyectoController::class, 'updateEstado'])->name('proyecto.updateEstado');
    Route::patch('/cambiar-etapa/{proyecto}', [ProyectoController::class, 'updateEtapa'])->name('proyecto.updateEtapa');
    Route::get('/add-resolucion/{proyecto}', [ProyectoController::class, 'addResolucion'])->name('proyecto.addResolucion');
    Route::post('/add-resolucion/{proyecto}', [ProyectoController::class, 'storeAddResolucion'])->name('proyecto.storeAddResolucion');
    Route::post('/proyectos/{id}', [ProyectoController::class, 'downloadResolucion'])->name('resolucion.download');
    Route::post('/proyectos/deleteResolucion/{id}', [ProyectoController::class, 'destroyResolucion'])->name('Proyecto.resolucion.destroy');
    Route::get('/crear-tesista',[TesistaController::class,'createForSecretaria'])->name('secretaria.crear-tesista');
    Route::post('/crear-tesista',[TesistaController::class,'storeForSecretaria'])->name('secretaria.store-tesista');
    Route::get('/crear-empresa',[EmpresaController::class,'createForSecretaria'])->name('secretaria.crear-empresa');
    Route::post('/crear-empresa',[EmpresaController::class,'storeForSecretaria'])->name('secretaria.store-empresa');
});

//Rutas para tesista
Route::group(['middleware' => ['auth', 'role:tesista']], function () {
    Route::resource('proyectoTesista', ProyectoTesistaController::class)->only(['index']);

    Route::get('/ver-estado/{proyecto}', [ProyectoTesistaController::class, 'verEstado'])->name('proyectoTesista.verEstado');
    Route::get('/proyectoTesista/createActividad/{proyecto}', [ProyectoTesistaController::class, 'crearActividad'])->name('proyectoTesista.crearActividad');
    Route::post('/proyectoTesista/createActividad/{proyecto}', [ProyectoTesistaController::class, 'storeActividad'])->name('proyectoTesista.storeActividad');
    Route::get('/proyectoTesista/editActividad/{proyecto}/{actividad}', [ProyectoTesistaController::class, 'editActividad'])->name('proyectoTesista.editActividad');
    Route::patch('/proyectoTesista/editActividad/{proyecto}{actividad}', [ProyectoTesistaController::class, 'updateActividad'])->name('proyectoTesista.updateActividad');
    Route::post('/proyectoTesistaUpdateFecha/{proyecto}', [ProyectoTesistaController::class, 'updateFecha'])->name('proyectoTesista.updateFecha');
    Route::post('/proyectoTesista/{id}', [ProyectoController::class, 'downloadResolucion'])->name('resolucionTesista.download');
});

//Rutas para asesor
Route::group(['middleware' => ['auth', 'role:asesor']], function () {
    Route::resource('proyectoAsesor', ProyectoAsesorController::class)->only(['index']);

    Route::get('/proyectoAsesor/ver-estado/{proyecto}', [ProyectoAsesorController::class, 'verEstado'])->name('proyectoAsesor.verEstado');
    Route::post('/proyectoAsesor/{id}', [ProyectoController::class, 'downloadResolucion'])->name('resolucionAsesor.download');
});

//Rutas para director de departamento
Route::group(['middleware' => ['auth', 'role:director']], function () {

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
