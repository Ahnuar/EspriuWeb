<?php

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


Auth::routes(['verify' => true]);
Route::fallback(function () {
    return redirect()->route('inici');
}); 

Route::get('/',[App\Http\Controllers\IniciController::class, 'index'])->name('inici');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/eventos',[App\Http\Controllers\EventosController::class,'index'])->name('eventos');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/facturacio',[App\Http\Controllers\FacturacioController::class,'index'])->name('facturacio');
    Route::get('/lista',[App\Http\Controllers\FacturacioController::class,'lista'])->name('lista');
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    
    Route::get('/home/gestioneventos', [App\Http\Controllers\adminFuncController::class, 'index'])->name('gestioneventos');

    Route::get('/home/altasbajasmonitores', [App\Http\Controllers\adminFuncController::class, 'mostrarviewmonitores'])->name('altasbajasmonitores');

    Route::post('/home/altasbajasmonitores/hacermonitor',[App\Http\Controllers\adminFuncController::class,'hacermonitor'])->name('hacermonitor');
    Route::post('/home/gestioneventos/evento',[App\Http\Controllers\adminFuncController::class,'buscarEvento'])->name('buscarEvento');
    Route::post('/home/gestioneventos/totsElsEvents',[App\Http\Controllers\adminFuncController::class,'mostrarTodos'])->name('mostrarTodos');
    Route::post('/home/gestioneventos/evento/modificar',[App\Http\Controllers\adminFuncController::class, 'modificarevento'])->name('modificarevento');
    Route::post('/home/gestioneventos/evento/insertar',[App\Http\Controllers\adminFuncController::class, 'insertarEvento'])->name('insertarEvento');
    Route::post('/home/gestioneventos/evento/eliminar',[App\Http\Controllers\adminFuncController::class, 'eliminarEvento'])->name('eliminarEvento');

    Route::post('/home/gestioNiu/horesXDia',[App\Http\Controllers\adminFuncController::class,'buscarHorasXDia'])->name('buscarHorasXDia');
    Route::post('/home/gestioNiu/hora',[App\Http\Controllers\adminFuncController::class,'buscarHora'])->name('buscarHora');


    Route::get('/home/gestioNiu', [App\Http\Controllers\adminFuncController::class, 'mostrarViewGestioNiu'])->name('gestioNiu');
    Route::post('/home/gestioNiu/hora/modificar', [App\Http\Controllers\adminFuncController::class, 'modificarHora'])->name('modificarHora');
    Route::post('/home/gestioNiu/hora/eliminar',[App\Http\Controllers\adminFuncController::class, 'eliminarHora'])->name('eliminarHora');
    Route::post('/home/gestioNiu/hora/insertar', [App\Http\Controllers\adminFuncController::class,'insertarHora'])->name('insertarHora');

    Route::post('/evento/signup', [App\Http\Controllers\EventosController::class,'signup'])->name('evento.signup');
    
    Route::get('/acogida', [App\Http\Controllers\HorasAcogidaController::class, 'index'])->name('acogida.index')->middleware('auth');
    Route::post('/acogida', [App\Http\Controllers\HorasAcogidaController::class, 'apuntar'])->name('acogida.apuntar')->middleware('auth');  
    
    Route::get('/niu', [App\Http\Controllers\HorasAcogidaController::class, 'index'])->name('niu.index')->middleware('auth');
    Route::post('/niu', [App\Http\Controllers\HorasAcogidaController::class, 'apuntar'])->name('niu.apuntar')->middleware('auth');
    Route::get('/niu/apuntar', [App\Http\Controllers\HorasAcogidaController::class, 'show'])->name('apuntar.show')->middleware('auth');
    Route::post('/niu/apuntar', [App\Http\Controllers\HorasAcogidaController::class, 'apuntarPeriodico'])->name('niu.apuntarPeriodico')->middleware('auth');

    Route::get('/home/gestioFills',[App\Http\Controllers\adminFuncController::class, 'mostrarViewGestioFills'])->name('gestioFills');
    Route::post('/home/gestioFills/insertar', [App\Http\Controllers\adminFuncController::class,'insertarFill'])->name('insertarFill');
    Route::post('home/assignarFill',[App\Http\Controllers\HomeController::class, 'assignarHijo'])->name('assignarHijo');
    Route::post('home/desassignarFill',[App\Http\Controllers\HomeController::class, 'desassignarHijo'])->name('desassignarHijo');

    Route::get('/obtenerFacturacion{mes}',  [App\Http\Controllers\facturacioController::class, 'obtenerFacturacion'])->name('datos.Facturacion');

    Route::get('/home/exportar',[App\Http\Controllers\HomeController::class, 'exportar'])->name('exportar');
});
