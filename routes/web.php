<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ArticulosController;

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

Route::get('/', [InicioController::class, 'index']);
Route::post('autorizar', [InicioController::class, 'autorizar']);
Route::get('/cerrar_sesion', [InicioController::class, 'cerrar_sesion']);
/* Clientes */
Route::get('v/clientes', [ClientesController::class, 'index']);
Route::get('clientes/lista', [ClientesController::class, 'clientes']);
Route::get('clientes/detalle/{cliente}', [ClientesController::class, 'show']);
/* Pedido */
Route::get('v/pedidos', [PedidosController::class, 'index']);
Route::get('pedidos/crear', [PedidosController::class, 'create']);
/* Artículos */
Route::get('articulos/lista', [ArticulosController::class, 'articulos']);