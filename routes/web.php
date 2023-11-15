<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
  
    Route::get('/', 'login')->name('login');
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
  
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});
  

  
Route::middleware('auth')->group(function () {

    Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('', 'index')->name('dashboard');
       
    });


    Route::controller(EmpresaController::class)->prefix('empresas')->group(function () {
        Route::get('', 'index')->name('empresas');
        Route::get('create', 'create')->name('empresas.create');
        Route::post('store', 'store')->name('empresas.store');
        Route::get('show/{id}', 'show')->name('empresas.show');
        Route::get('edit/{id}', 'edit')->name('empresas.edit');
        Route::put('edit/{id}', 'update')->name('empresas.update');
        Route::delete('destroy/{id}', 'destroy')->name('empresas.destroy');
    });

    Route::controller(CategoriaController::class)->prefix('categorias')->group(function () {
        Route::get('', 'index')->name('categorias');
        Route::get('create', 'create')->name('categorias.create');
        Route::post('store', 'store')->name('categorias.store');
        Route::get('show/{id}', 'show')->name('categorias.show');
        Route::get('edit/{id}', 'edit')->name('categorias.edit');
        Route::put('edit/{id}', 'update')->name('categorias.update');
        Route::delete('destroy/{id}', 'destroy')->name('categorias.destroy');
    });

    Route::controller(SubcategoriaController::class)->prefix('subcategorias')->group(function () {
        Route::get('', 'index')->name('subcategorias');
        Route::get('create', 'create')->name('subcategorias.create');
        Route::post('store', 'store')->name('subcategorias.store');
        Route::get('show/{id}', 'show')->name('subcategorias.show');
        Route::get('edit/{id}', 'edit')->name('subcategorias.edit');
        Route::put('edit/{id}', 'update')->name('subcategorias.update');
        Route::delete('destroy/{id}', 'destroy')->name('subcategorias.destroy');
    });


    Route::controller(ProveedorController::class)->prefix('proveedores')->group(function () {
        Route::get('', 'index')->name('proveedores');
        Route::get('create', 'create')->name('proveedores.create');
        Route::post('store', 'store')->name('proveedores.store');
        Route::get('show/{id}', 'show')->name('proveedores.show');
        Route::get('edit/{id}', 'edit')->name('proveedores.edit');
        Route::put('edit/{id}', 'update')->name('proveedores.update');
        Route::delete('destroy/{id}', 'destroy')->name('proveedores.destroy');
    });


    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('', 'index')->name('users');
        Route::get('create', 'create')->name('users.create');
        Route::post('store', 'store')->name('users.store');
        Route::get('show/{id}', 'show')->name('users.show');
        Route::get('edit/{id}', 'edit')->name('users.edit');
        Route::put('edit/{id}', 'update')->name('users.update');
        Route::delete('destroy/{id}', 'destroy')->name('users.destroy');
    });

    Route::post('/actualizar-usuario', 'UserController@actualizarUsuario');
});