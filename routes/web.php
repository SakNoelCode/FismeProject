<?php

//use App\Http\Controllers\ActaController;
use App\Http\Controllers\Asesor\ProyectoAsesorController;
//use App\Http\Controllers\DocenteController;
//use App\Http\Controllers\PracticanteController;
use App\Http\Controllers\Admin\EmpresaController;
use App\Http\Controllers\Admin\TesistaController;
use App\Http\Controllers\Auth\RegisteredUserTramite;
use App\Http\Controllers\Practicante\AuthController as PracticanteAuthController;
use App\Http\Controllers\Practicante\PracticaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\Secretaria\ExpedienteController as SecretariaExpedienteController;
use App\Http\Controllers\Tesista\ProyectoTesistaController;
//use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\Tramite\ExpedienteController as TramiteExpedienteController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:tesista|secretaria|asesor|director'])->name('dashboard');

//Rutas para la gestión del home con respecto al trámite
Route::get('/login-tramite', [RegisteredUserTramite::class, 'login'])->name('login.tramite');
Route::post('/login-tramite', [RegisteredUserTramite::class, 'loginAutenticate'])->name('login.autenticate.tramite');
Route::get('/register-user-tramite', [RegisteredUserTramite::class, 'create'])->name('register.user.tramite');
Route::post('/register-user-tramite', [RegisteredUserTramite::class, 'store'])->name('store.user.tramite');

//Rutas para ralizar los trámites 
Route::group(['middleware' => ['auth', 'role:remitente']], function () {
    Route::prefix('tramites')->group(function () {
        Route::get('/', [TramiteExpedienteController::class, 'showHome'])->name('tramite.showHome');
        Route::get('/CreateDatosRemitente',[TramiteExpedienteController::class,'createDatosRemitente'])->name('tramite.createDatosRemitente');
        Route::post('/CreateDatosRemitente',[TramiteExpedienteController::class,'storeDatosRemitente'])->name('tramite.storeDatosRemitente');
        Route::get('/expedientes',[TramiteExpedienteController::class,'indexExpedienteRemitente'])->name('tramite.indexExpedienteRemitente');
        Route::get('/expedientes/create',[TramiteExpedienteController::class,'createExpedienteRemitente'])->name('tramite.createExpedienteRemitente');
        Route::post('/expedientes/create',[TramiteExpedienteController::class,'storeExpedienteRemitente'])->name('tramite.storeExpedienteRemitente');
        Route::get('/expedientes/ver-pdf/{name}',[TramiteExpedienteController::class,'verPdf'])->name('tramite.verPdfExpediente');
    });
});

//Rutas para el inicio de sesión de practicantes
Route::get('/show-login-practicante',[PracticanteAuthController::class,'showLogin'])->name('practicante.auth.showLogin');
Route::post('/show-login-practicante',[PracticanteAuthController::class,'login'])->name('practicante.auth.login');

Route::group(['middleware' => ['auth', 'role:practicante']], function () {
    Route::prefix('practicas')->group(function () {
        Route::get('/', [PracticaController::class, 'showHome'])->name('practicante.showHome');
    });
});

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
    Route::get('/crear-tesista', [TesistaController::class, 'createForSecretaria'])->name('secretaria.crear-tesista');
    Route::post('/crear-tesista', [TesistaController::class, 'storeForSecretaria'])->name('secretaria.store-tesista');
    Route::get('/crear-empresa', [EmpresaController::class, 'createForSecretaria'])->name('secretaria.crear-empresa');
    Route::post('/crear-empresa', [EmpresaController::class, 'storeForSecretaria'])->name('secretaria.store-empresa');

    //Expedientes
    Route::get('/expedientes', [SecretariaExpedienteController::class, 'index'])->name('secretaria.expedientes.index');
    Route::get('/ver-pdf/{name}', [SecretariaExpedienteController::class, 'verPDF'])->name('secretaria.expediente.ver-pdf');
    Route::get('/expediente/{expediente}/atender', [SecretariaExpedienteController::class, 'atenderExpediente'])->name('secretaria.expediente.atender');
    Route::post('/expediente/{expediente}/atender', [SecretariaExpedienteController::class, 'addHistorialExpediente'])->name('secretaria.expediente.historial.store');
    Route::patch('/expediente/cambiarEstado/{id}', [SecretariaExpedienteController::class, 'cambiarEstadoExpediente'])->name('secretaria.expediente.cambiarEstado');
    Route::patch('/expediente/derivar/{id}', [SecretariaExpedienteController::class, 'derivarAreaExpediente'])->name('secretaria.expediente.derivarArea');
    Route::patch('/expediente/AsignarCorrelativo/{id}', [SecretariaExpedienteController::class, 'asignarCorrelativo'])->name('secretaria.expediente.asignarCorrelativo');
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
Route::group(['middleware' => ['auth', 'role:director|secretaria']], function () {
   // Route::resource('docentes', DocenteController::class);
   // Route::resource('practicantes', PracticanteController::class);
   // Route::resource('actas', ActaController::class);
});

//rutas para cargar doc practicas
//Route::get('/crear-doc', [DocumentoController::class, 'create'])->name('practicas.crearDocumento');
//Route::post('/crear-doc', [DocumentoController::class, 'store'])->name('practicas.guardarDocumento');

//rutas para envio de emails
//Route::get('/enviar-email/{practicantes}/{archivo}', [DocumentoController::class, 'enviarEmail'])->name('enviarEmail');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
