<?php

use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\ClienteController;
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

Route::post('cliente', [ClienteController::class, 'store']);
Route::resource('cliente/{idCliente}/chamado', ChamadoController::class)->only(['index', 'show', 'store']);
