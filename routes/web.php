<?php

use App\Http\Controllers\facturacion\ConsumidorFinalController;
use App\Http\Controllers\general\ClienteController;
use App\Http\Controllers\general\EmpresaController;
use App\Http\Controllers\general\ProductoController;
use App\Models\facturacion\ConsumidorFinal;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('empresa', EmpresaController::class);
    Route::resource('cliente', ClienteController::class);
    Route::resource('producto', ProductoController::class);

    //facturacion
    Route::resource('consumidor_final', ConsumidorFinalController::class);
});
