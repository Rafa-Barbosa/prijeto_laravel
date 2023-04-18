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

use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index']);

// ============ Pedidos ================
Route::get('/registrarEncomendas', [EventController::class, 'registrarEncomendas']);
Route::post('/salvarEncomendas', [EventController::class, 'salvarEncomendas']);
Route::get('/encomendas', [EventController::class, 'encomendas']);

// ============ Clientes ================
Route::get('/registrarClientes', [EventController::class, 'registrarClientes']);
Route::post('/salvarClientes', [EventController::class, 'salvarClientes']);
Route::get('/relatorioClientes', [EventController::class, 'relatorioClientes']);
