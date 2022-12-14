<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\perroController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/tinder')->group(function () use ($router) {
    $router->post('/postPerro', [PerroController::class, 'guardarPerro']);
    $router->get('/getPerroAzar', [PerroController::class, 'verPerroAzar']);
    $router->get('/getPerro', [PerroController::class, 'verPerro']);
    $router->post('/borrarPerro', [PerroController::class, 'eliminarPerro']);
    $router->post('/actualizarPerro', [PerroController::class, 'actualizarPerro']);

    $router->post('/cambiarInteraccion', [PerroController::class, 'cambiarInteraccion']);

    $router->get('/verInteresadosAceptados', [PerroController::class, 'verInteresadosAceptados']);
    $router->get('/verInteresadosRechazados', [PerroController::class, 'verInteresadosRechazados']);


    $router->post('/postInteraccion', [PerroController::class, 'guardarInteraccion']);
});
