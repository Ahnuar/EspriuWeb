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

Route::get('/acogida', [App\Http\Controllers\HorasAcogidaController::class, 'index'])->name('acogida.index')->middleware('auth');
Route::post('/acogida', [App\Http\Controllers\HorasAcogidaController::class, 'apuntar'])->name('acogida.apuntar')->middleware('auth');

