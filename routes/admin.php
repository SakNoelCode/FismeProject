<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AsesorController;
use App\Http\Controllers\Admin\EmpresaController;
use App\Http\Controllers\Admin\SecretariaController;
use App\Http\Controllers\Admin\TesistaController;
use App\Http\Controllers\Admin\UserController;
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


Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login');


Route::group(['middleware' => ['auth', 'role:administrador']], function () {

    Route::prefix('admin')->group(function () {

        Route::get('/dashboard', [AdminHomeController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminHomeController::class, 'logout'])->name('admin.logout');

        Route::get('/empresas-fetch',[EmpresaController::class,'fetchEmpresas'])->name('fetchEmpresas');
        Route::get('/edit-empresa/{id}',[EmpresaController::class,'editEmpresa'])->name('editEmpresa');
        Route::put('/edit-empresa/{id}',[EmpresaController::class,'updateEmpresa'])->name('updateEmpresa');

        Route::resources([
            'usuarios' => UserController::class,
            'tesistas' => TesistaController::class,
            'asesores' => AsesorController::class,
            'secretarias' => SecretariaController::class,
            'empresas' => EmpresaController::class
        ]);
        
        //Route::post('/buscar-usuario', [AdminUserController::class, 'buscarUsuario'])->name('admin.usuarios.buscar');

        Route::prefix('iconos')->group(function () {
        });
    });
});
