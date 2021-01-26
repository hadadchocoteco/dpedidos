<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\PresentacionesController;

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
Route::get('pedidos/consulta/temporal', [PedidosController::class, 'cargar_pedido_temporal']);
Route::post('pedidos/guardar/temporal', [PedidosController::class, 'guardar_pedido_temporal']);
Route::get('pedidos/guardar', [PedidosController::class, 'store']);
/* Artículos */
Route::get('articulos/lista', [ArticulosController::class, 'articulos']);
Route::get('articulos/consulta/precio', [ArticulosController::class, 'articulos_precio']);
/* Presentaciones */
Route::get('presentaciones/lista', [PresentacionesController::class, 'presentaciones']);