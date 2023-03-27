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

Auth::routes();

Route::get('/eventos',[App\Http\Controllers\EventosController::class,'index'])->name('eventos');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/evento/{evento}/signup', [App\Http\Controllers\EventosController::class,'signup'])->name('evento.signup');

Route::get('/niu', [App\Http\Controllers\HorasAcogidaController::class, 'index'])->name('niu.index')->middleware('auth');
Route::post('/niu', [App\Http\Controllers\HorasAcogidaController::class, 'apuntar'])->name('niu.apuntar')->middleware('auth');
Route::get('/niu/apuntar', [App\Http\Controllers\HorasAcogidaController::class, 'show'])->name('apuntar.show')->middleware('auth');

