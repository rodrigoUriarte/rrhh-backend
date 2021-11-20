<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\TipoContratoController;
use App\Http\Controllers\TipoSolicitudController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::group([
    //'middleware' => ['auth:sanctum'],
], function(){
    Route::apiResource('empleados', EmpleadoController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('empresas', EmpresaController::class);
    Route::apiResource('areas', AreaController::class);
    Route::apiResource('departamentos', DepartamentoController::class);
    Route::apiResource('cargos', CargoController::class);
    Route::apiResource('contratos', ContratoController::class);
    Route::apiResource('tiposContrato', TipoContratoController::class);
    Route::apiResource('solicitudes', SolicitudController::class);
    Route::apiResource('tiposSolicitud', TipoSolicitudController::class);
});
Route::post('/login', LoginController::class);
