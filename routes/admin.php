<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\AsesorController;
use App\Http\Controllers\Admin\EmpresaController;
use App\Http\Controllers\Admin\SecretariaController;
use App\Http\Controllers\Admin\TesistaController;
use App\Http\Controllers\Admin\TipoDocumentoController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Area;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.index');
});


Route::post('/login-admin', [AdminAuthController::class, 'login'])->name('admin.login');


Route::group(['middleware' => ['auth', 'role:administrador']], function () {

    Route::prefix('admin')->group(function () {

        Route::get('/dashboard', [AdminHomeController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminHomeController::class, 'logout'])->name('admin.logout');

        Route::get('/empresas-fetch', [EmpresaController::class, 'fetchEmpresas'])->name('fetchEmpresas');
        Route::get('/edit-empresa/{id}', [EmpresaController::class, 'editEmpresa'])->name('editEmpresa');
        Route::put('/edit-empresa/{id}', [EmpresaController::class, 'updateEmpresa'])->name('updateEmpresa');

        Route::resource('usuarios', UserController::class)->only(['index']);
        Route::resource('asesores', AsesorController::class)->except(['show', 'index', 'destroy']);
        Route::resource('tesistas', TesistaController::class)->except(['show', 'index', 'destroy']);
        Route::resource('secretarias', SecretariaController::class)->except(['show', 'index', 'destroy']);
        Route::resource('empresas', empresaController::class)->only(['index', 'store', 'destroy']);

        Route::get('/tipo-documento', [TipoDocumentoController::class, 'index'])->name('admin.TipoDocument.index');
        Route::get('/tipo-documento-fetch', [TipoDocumentoController::class, 'fetchTipodocumentos'])->name('fetchTipodocumentos');
        Route::post('/tipo-documento', [TipoDocumentoController::class, 'store'])->name('storeTipodocumentos');
        Route::get('/edit-tipodocumento/{id}', [TipoDocumentoController::class, 'editTipodocumento'])->name('editTipodocumento');
        Route::put('/edit-tipodocumento/{id}', [TipoDocumentoController::class, 'updateTipodocumento'])->name('updateTipodocumento');
        Route::delete('/delete-tipodocumento/{id}', [TipoDocumentoController::class, 'destroy'])->name('destroyTipodocumento');

        Route::get('/areas', [AreaController::class, 'index'])->name('admin.area.index');
        Route::get('/area-fetch', [AreaController::class, 'fetchRegistros'])->name('admin.area.fecth');
        Route::post('/areas', [AreaController::class, 'store'])->name('admin.area.store');
        Route::get('/edit-area/{id}', [AreaController::class, 'editRegistro'])->name('admin.area.edit');
        Route::put('/edit-area/{id}', [AreaController::class, 'updateRegistro'])->name('admin.area.update');
        Route::delete('/delete-area/{id}', [AreaController::class, 'destroy'])->name('admin.area.destroy');
    });
});
