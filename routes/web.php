<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TipouserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\TipomembresiaController;
use App\Http\Controllers\TipocontactoController;
use App\Http\Controllers\ClienteController;
use App\Models\Tipocontacto;

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


    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('', 'index')->name('users');
        Route::get('create', 'create')->name('users.create');
        Route::post('store', 'store')->name('users.store');
        Route::get('show/{id}', 'show')->name('users.show');
        Route::get('edit/{id}', 'edit')->name('users.edit');
        Route::put('edit/{id}', 'update')->name('users.update');
        Route::delete('destroy/{id}', 'destroy')->name('users.destroy');
        // Agrega la siguiente línea para la nueva ruta
        Route::post('update-empresa', 'updateEmpresa')->name('users.updateEmpresa');
    });

    Route::controller(TipouserController::class)->prefix('tipousers')->group(function () {
        Route::get('', 'index')->name('tipousers');
        Route::get('create', 'create')->name('tipousers.create');
        Route::post('store', 'store')->name('tipousers.store');
        Route::get('show/{id}', 'show')->name('tipousers.show');
        Route::get('edit/{id}', 'edit')->name('tipousers.edit');
        Route::put('edit/{id}', 'update')->name('tipousers.update');
        Route::delete('destroy/{id}', 'destroy')->name('tipousers.destroy');
        Route::get('permiso/{id}', 'permiso')->name('tipousers.permiso');
         Route::put('permiso/{id}', 'permisoupdate')->name('tipousers.permisoupdate');
    });

    Route::controller(ModuleController::class)->prefix('modules')->group(function () {
        Route::get('', 'index')->name('modules');
        Route::get('create', 'create')->name('modules.create');
        Route::post('store', 'store')->name('modules.store');
        Route::get('show/{id}', 'show')->name('modules.show');
        Route::get('edit/{id}', 'edit')->name('modules.edit');
        Route::put('edit/{id}', 'update')->name('modules.update');
        Route::delete('destroy/{id}', 'destroy')->name('modules.destroy');
    });

    Route::controller(TipomembresiaController::class)->prefix('tipomembresias')->group(function () {
        Route::get('', 'index')->name('tipomembresias');
        Route::get('create', 'create')->name('tipomembresias.create');
        Route::post('store', 'store')->name('tipomembresias.store');
        Route::get('show/{id}', 'show')->name('tipomembresias.show');
        Route::get('edit/{id}', 'edit')->name('tipomembresias.edit');
        Route::put('edit/{id}', 'update')->name('tipomembresias.update');
        Route::delete('destroy/{id}', 'destroy')->name('tipomembresias.destroy');
    });

    Route::controller(ClienteController::class)->prefix('clientes')->group(function () {
        Route::get('', 'index')->name('clientes');
        Route::get('create', 'create')->name('clientes.create');
        Route::post('store', 'store')->name('clientes.store');
        Route::get('show/{id}', 'show')->name('clientes.show');
        Route::get('edit/{id}', 'edit')->name('clientes.edit');
        Route::put('edit/{id}', 'update')->name('clientes.update');
        Route::delete('destroy/{id}', 'destroy')->name('clientes.destroy');
    });

    Route::controller(TipocontactoController::class)->prefix('tipocontactos')->group(function () {
        Route::get('', 'index')->name('tipocontactos');
        Route::get('create', 'create')->name('tipocontactos.create');
        Route::post('store', 'store')->name('tipocontactos.store');
        Route::get('show/{id}', 'show')->name('tipocontactos.show');
        Route::get('edit/{id}', 'edit')->name('tipocontactos.edit');
        Route::put('edit/{id}', 'update')->name('tipocontactos.update');
        Route::delete('destroy/{id}', 'destroy')->name('tipocontactos.destroy');
    });

   

    //Route::post('/actualizar-empresa', 'UserController@updateEmpresa');



    /*Route::controller(ProductoController::class)->prefix('productos')->group(function () {
        Route::get('', 'index')->name('productos');
        Route::get('create', 'create')->name('productos.create');
        Route::post('store', 'store')->name('productos.store');
        Route::get('show/{id}', 'show')->name('productos.show');
        Route::get('edit/{id}', 'edit')->name('productos.edit');
        Route::put('edit/{id}', 'update')->name('productos.update');
        Route::delete('destroy/{id}', 'destroy')->name('productos.destroy');
    });*/

});