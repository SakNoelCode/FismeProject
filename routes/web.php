<?php

use App\Http\Controllers\Asesor\ProyectoAsesorController;
use App\Http\Controllers\Admin\EmpresaController;
use App\Http\Controllers\Admin\TesistaController;
use App\Http\Controllers\Auth\RegisteredUserTramite;
use App\Http\Controllers\Director\ComisionController;
use App\Http\Controllers\Practicante\AuthController as PracticanteAuthController;
use App\Http\Controllers\Practicante\PracticaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\Secretaria\ExpedienteController as SecretariaExpedienteController;
use App\Http\Controllers\Secretaria\PracticaController as SecretariaPracticaController;
use App\Http\Controllers\Secretaria\ProyectoController as SecretariaProyectoController;
use App\Http\Controllers\Asesor\PracticaController as AsesorPracticaController;
use App\Http\Controllers\Asesor\ComisionController as AsesorComisionController;
use App\Http\Controllers\Tesista\ProyectoTesistaController;
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
Route::get('/login-practicante', [PracticanteAuthController::class, 'showLogin'])->name('practicante.auth.showLogin');
Route::post('/login-practicante', [PracticanteAuthController::class, 'login'])->name('practicante.auth.login');
Route::get('/register-practicante', [PracticanteAuthController::class, 'showRegister'])->name('practicante.auth.showRegister');
Route::post('/register-practicante', [PracticanteAuthController::class, 'register'])->name('practicante.auth.register');

//Rutas para ralizar los trámites externos
Route::group(['middleware' => ['auth', 'role:remitente']], function () {
    Route::prefix('tramites')->group(function () {
        Route::get('/', [TramiteExpedienteController::class, 'showHome'])->name('tramite.showHome');
        Route::get('/CreateDatosRemitente', [TramiteExpedienteController::class, 'createDatosRemitente'])->name('tramite.createDatosRemitente');
        Route::post('/CreateDatosRemitente', [TramiteExpedienteController::class, 'storeDatosRemitente'])->name('tramite.storeDatosRemitente');
        Route::get('/expedientes', [TramiteExpedienteController::class, 'indexExpedienteRemitente'])->name('tramite.indexExpedienteRemitente');
        Route::get('/expedientes/create', [TramiteExpedienteController::class, 'createExpedienteRemitente'])->name('tramite.createExpedienteRemitente');
        Route::post('/expedientes/create', [TramiteExpedienteController::class, 'storeExpedienteRemitente'])->name('tramite.storeExpedienteRemitente');
        Route::get('/expedientes/ver-pdf/{name}', [TramiteExpedienteController::class, 'verPdf'])->name('tramite.verPdfExpediente');
        Route::get('/expedientes/respuestas', [TramiteExpedienteController::class, 'showRespuestasExpedienteRemitente'])->name('tramite.showRespuestasExpedienteRemitente');
        Route::get('/expediente/respuesta/{expediente}', [TramiteExpedienteController::class, 'showRespuestaExpedienteRemitente'])->name('tramite.showRespuestaExpedienteRemitente');
        Route::get('/dowloadHistorial/{expediente}', [TramiteExpedienteController::class, 'downloadHistorial'])->name('tramite.dowloadHistorial');
    });
});

//Rutas para el practicante
Route::group(['middleware' => ['auth', 'role:practicante']], function () {
    Route::prefix('practicas')->group(function () {
        Route::get('/', [PracticaController::class, 'showHome'])->name('practicante.showHome');
        Route::get('/create-practicante', [PracticaController::class, 'createPracticante'])->name('practicante.createPracticante');
        Route::post('/create-practicante', [PracticaController::class, 'storePracticante'])->name('practicante.storePracticante');
        Route::get('/create-practica', [PracticaController::class, 'createPractica'])->name('practicante.createPractica');
        Route::post('/create-practica', [PracticaController::class, 'storePractica'])->name('practicante.storePractica');
        Route::get('/create-actas', [PracticaController::class, 'createActas'])->name('practicante.createActas');
        Route::post('/create-actas', [PracticaController::class, 'storeActas'])->name('practicante.storeActas');
        Route::get('/ver-pdf/{name}', [PracticaController::class, 'verPDF'])->name('practicante.verPDF');
        Route::get('/generate-solicitud-aprobacion-practica', [PracticaController::class, 'generateSolicitudAprobacionPractica'])->name('practicante.generateSolicitudAprobacionPractica');
        Route::post('/generate-solicitud-aprobacion-practica', [PracticaController::class, 'generateSolicitudAprobacionPracticaPDF'])->name('practicante.generateSolicitudAprobacionPracticaPDF');
        Route::get('/informe-final', [PracticaController::class, 'createInformeFinal'])->name('practicante.create-informe-final');
        Route::post('/informe-final', [PracticaController::class, 'storeInformeFinal'])->name('practicante.store-informe-final');
        Route::get('/ver-pdf-informe/{name}', [PracticaController::class, 'verPDFInforme'])->name('practicante.verPDFInforme');
    });
});

//Rutas para la secretaría:
Route::group(['middleware' => ['auth', 'role:secretaria']], function () {
    Route::resources(['proyectos' => ProyectoController::class]);

    Route::prefix('secretaria')->group(function () {

        Route::prefix('proyecto')->group(function () {
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
            Route::get('/asignar-jurado/{proyecto}', [SecretariaProyectoController::class, 'showAsignarJurado'])->name('secretaria.proyecto.showAsignarJurado');
            Route::post('/asignar-jurado/{proyecto}', [SecretariaProyectoController::class, 'saveAsignarJurado'])->name('secretaria.proyecto.saveAsignarJurado');
            Route::get('/crear-asesor', [SecretariaProyectoController::class, 'showCrearAsesor'])->name('secretaria.crear-asesor');
            Route::post('/crear-asesor', [SecretariaProyectoController::class, 'saveAsesor'])->name('secretaria.save-asesor');
        });

        //Expedientes
        Route::get('/expedientes', [SecretariaExpedienteController::class, 'index'])->name('secretaria.expedientes.index');
        Route::get('/expediente/ver-pdf/{name}', [SecretariaExpedienteController::class, 'verPDF'])->name('secretaria.expediente.ver-pdf');
        Route::get('/expediente/{expediente}/atender', [SecretariaExpedienteController::class, 'atenderExpediente'])->name('secretaria.expediente.atender');
        Route::post('/expediente/{expediente}/atender', [SecretariaExpedienteController::class, 'addHistorialExpediente'])->name('secretaria.expediente.historial.store');
        Route::patch('/expediente/cambiarEstado/{id}', [SecretariaExpedienteController::class, 'cambiarEstadoExpediente'])->name('secretaria.expediente.cambiarEstado');
        Route::patch('/expediente/derivar/{id}', [SecretariaExpedienteController::class, 'derivarAreaExpediente'])->name('secretaria.expediente.derivarArea');
        Route::get('/expedientes/enviarDocumento', [SecretariaExpedienteController::class, 'enviarDocumento'])->name('secretaria.expediente.enviarDocumento');
        Route::post('/expedientes/enviarDocumento', [SecretariaExpedienteController::class, 'storeEnviarDocumento'])->name('secretaria.expediente.storeEnviarDocumento');
        Route::get('/expedientes/enviarDocumentoDocente', [SecretariaExpedienteController::class, 'enviarDocumentoDocente'])->name('secretaria.expediente.enviarDocumentoDocente');
        Route::post('/expedientes/enviarDocumentoDocente', [SecretariaExpedienteController::class, 'storeEnviarDocumentoDocente'])->name('secretaria.expediente.storeEnviarDocumentoDocente');
        Route::post('/expedientes/archivarExpediente/{expediente}', [SecretariaExpedienteController::class, 'archivarExpediente'])->name('secretaria.expediente.achivarExpediente');
        Route::get('/expedientes/expediente-fisico', [SecretariaExpedienteController::class, 'registrarExpedienteFisico'])->name('secretaria.expediente.registrarExpedienteFisico');
        Route::post('/expedientes/expediente-fisico', [SecretariaExpedienteController::class, 'storeExpedienteFisico'])->name('secretaria.expediente.storeExpedienteFisico');
        Route::get('/expedientes/filtrar-expedientes', [SecretariaExpedienteController::class, 'filtrarExpedientes'])->name('secretaria.expediente.filtrarExpedientes');
        Route::get('/dowloadExpediente/{fechainicio}/{fechafin}', [SecretariaExpedienteController::class, 'downloadExpediente'])->name('secretaria.expediente.downloadExpediente');

        //practicas
        Route::get('/practicas', [SecretariaPracticaController::class, 'index'])->name('secretaria.practicas.index');
        Route::post('/saveSustentacion/{practica}', [SecretariaPracticaController::class, 'updateSustentacion'])->name('secretaria.practicas.updateSustentacion');
        Route::post('/updateEstado/{practica}', [SecretariaPracticaController::class, 'updateEstado'])->name('secretaria.practicas.updateEstado');
        Route::post('/updateEtapa/{practica}', [SecretariaPracticaController::class, 'updateEtapa'])->name('secretaria.practicas.updateEtapa');
        Route::post('/loadFilePractica/{practica}', [SecretariaPracticaController::class, 'loadFilePractica'])->name('secretaria.practicas.loadFilePractica');
        Route::get('/practica/ver-pdf/{name}', [SecretariaPracticaController::class, 'verPDF'])->name('secretaria.practica.ver-pdf');
        Route::post('/uploadCargo/{practica}', [SecretariaPracticaController::class, 'uploadCargo'])->name('secretaria.practicas.uploadCargo');
        Route::patch('/crearProveidoSolicitud/{practica}', [SecretariaPracticaController::class, 'crearProveidoSolicitud'])->name('secretaria.practicas.crearProveidoSolicitud');
    });
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

    Route::prefix('asesor')->group(function () {
        Route::get('/proyectoAsesor/ver-estado/{proyecto}', [ProyectoAsesorController::class, 'verEstado'])->name('proyectoAsesor.verEstado');
        Route::post('/proyectoAsesor/{id}', [ProyectoController::class, 'downloadResolucion'])->name('resolucionAsesor.download');

        Route::prefix('practica')->group(function () {
            Route::get('/', [AsesorPracticaController::class, 'index'])->name('asesor.practica.index');
        });

        Route::prefix('comision')->group(function () {
            Route::get('/', [AsesorComisionController::class, 'index'])->name('asesor.comision.index');
            Route::get('/ver-pdf/{name}', [AsesorComisionController::class, 'verPDF'])->name('asesor.comision.ver-pdf');
            Route::get('/ver-acta-revision/{practica}', [AsesorComisionController::class, 'verActaRevision'])->name('asesor.comision.ver-acta-revision');
            Route::post('/updateFechaSustentacion/{id}', [AsesorComisionController::class, 'updateFechaSustentacion'])->name('asesor.comision.updateFechaSustentacion');
            Route::get('/generateActaSustentacionView/{practicante}',[AsesorComisionController::class,'generateActaSustentacionView'])->name('asesor.comision.generateActaSustentacionView');
            Route::post('/generateActaSustentacionView/{practicante}',[AsesorComisionController::class,'generateActaSustentacion'])->name('asesor.comision.generateActaSustentacion');
            Route::get('/generateActaRevisionView/{practicante}',[AsesorComisionController::class,'generateActaRevisionView'])->name('asesor.comision.generateActaRevisionView');
            Route::post('/generateActaRevisionView/{practicante}',[AsesorComisionController::class,'generateActaRevision'])->name('asesor.comision.generateActaRevision');
            Route::post('/subirActaRevision/{practicante}',[AsesorComisionController::class,'subirActaRevision'])->name('asesor.comision.subirActaRevision');
        });
    });
});

//Rutas para director de departamento
Route::group(['middleware' => ['auth', 'role:director']], function () {
    Route::get('/comision', [ComisionController::class, 'index'])->name('director.comision.index');
    Route::get('/comision/create', [ComisionController::class, 'create'])->name('director.comision.create');
    Route::post('/comision/create', [ComisionController::class, 'update'])->name('director.comision.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
