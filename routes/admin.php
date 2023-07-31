<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminHomeController;
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


Route::group(['middleware' => ['auth','role:administrador']], function () {

    Route::prefix('admin')->group(function () {

        Route::get('/dashboard', [AdminHomeController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminHomeController::class, 'logout'])->name('admin.logout');


        Route::resource('usuarios',UserController::class);
        //Route::post('/buscar-usuario', [AdminUserController::class, 'buscarUsuario'])->name('admin.usuarios.buscar');

        Route::prefix('iconos')->group(function () {
        });
    });
});
