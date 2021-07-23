<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\FiliaisController;
use App\Http\Controllers\FiliaisDepartamentosController;
use App\Http\Controllers\NiveisController;
use App\Http\Controllers\OrdemComprasController;
use App\Http\Controllers\TiposController;
use App\Http\Controllers\VeiculosController;
use App\Http\Controllers\UsuariosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('departamentos', [DepartamentosController::class, 'index']);
Route::get('departamento/{id}', [DepartamentosController::class, 'show']);
Route::post('departamento', [DepartamentosController::class, 'store']);
Route::put('departamento/{id}', [DepartamentosController::class, 'update']);
Route::delete('departamento/{id}', [DepartamentosController::class,'destroy']);

Route::get('filiais', [FiliaisController::class, 'index']);
Route::get('filial/{id}', [FiliaisController::class, 'show']);
Route::post('filial', [FiliaisController::class, 'store']);
Route::put('filial/{id}', [FiliaisController::class, 'update']);
Route::delete('filial/{id}', [FiliaisController::class,'destroy']);

Route::get('filiaisdepartamentos', [FiliaisDepartamentosController::class, 'index']);
Route::get('filiaisdepartamento/{id}', [FiliaisDepartamentosController::class, 'show']);
Route::post('filiaisdepartamento', [FiliaisDepartamentosController::class, 'store']);
Route::put('filiaisdepartamento/{id}', [FiliaisDepartamentosController::class, 'update']);
Route::delete('filiaisdepartamento/{id}', [FiliaisDepartamentosController::class,'destroy']);

Route::get('usuarios', [UsuariosController::class, 'index']);
Route::get('usuario/{id}', [UsuariosController::class, 'show']);
Route::post('usuario', [UsuariosController::class, 'store']);
Route::put('usuario/{id}', [UsuariosController::class, 'update']);
Route::delete('usuario/{id}', [UsuariosController::class,'destroy']);

Route::get('niveis', [NiveisController::class, 'index']);
Route::get('nivel/{id}', [NiveisController::class, 'show']);
Route::post('nivel', [NiveisController::class, 'store']);
Route::put('nivel/{id}', [NiveisController::class, 'update']);
Route::delete('nivel/{id}', [NiveisController::class,'destroy']);

Route::get('ordenscompra', [OrdemComprasController::class, 'index']);
Route::get('ordemcompra/{id}', [OrdemComprasController::class, 'show']);
Route::post('ordemcompra', [OrdemComprasController::class, 'store']);
Route::put('ordemcompra/{id}', [OrdemComprasController::class, 'update']);
Route::delete('ordemcompra/{id}', [OrdemComprasController::class,'destroy']);

Route::get('veiculos', [VeiculosController::class, 'index']);
Route::get('veiculo/{id}', [VeiculosController::class, 'show']);
Route::post('veiculo', [VeiculosController::class, 'store']);
Route::put('veiculo/{id}', [VeiculosController::class, 'update']);
Route::delete('veiculo/{id}', [VeiculosController::class,'destroy']);

Route::get('tipos', [TiposController::class, 'index']);
Route::get('tipo/{id}', [TiposController::class, 'show']);
Route::post('tipo', [TiposController::class, 'store']);
Route::put('tipo/{id}', [TiposController::class, 'update']);
Route::delete('tipo/{id}', [TiposController::class,'destroy']);

Route::get('clientes', [ClientesController::class, 'index']);
Route::get('cliente/{id}', [ClientesController::class, 'show']);
Route::post('cliente', [ClientesController::class, 'store']);
Route::put('cliente/{id}', [ClientesController::class, 'update']);
Route::delete('cliente/{id}', [ClientesController::class,'destroy']);
