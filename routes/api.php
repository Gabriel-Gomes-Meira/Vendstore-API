<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProdutosController;

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
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/admin', [AuthController::class, 'userProfile']);

    //For Produtos
    Route::get('/produtos', [ProdutosController::class, 'index']);
    Route::post('/produtos/create', [ProdutosController::class, 'create']);
    Route::post('/produtos/update', [ProdutosController::class, 'update']);
    Route::post('/produtos/delete', [ProdutosController::class, 'delete']);

    //For Marcas
    Route::get('/marcas', [MarcaController::class, 'index']);
    Route::post('/marcas/create', [MarcaController::class, 'create']);
    Route::post('/marcas/update', [MarcaController::class, 'update']);
    Route::post('/marcas/delete', [MarcaController::class, 'delete']);
});
