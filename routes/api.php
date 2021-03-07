<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\MoedaController;
use App\Http\Controllers\ProdutosController;


//For User
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/admin', [AuthController::class, 'Admthencate']);
});

//For Produtos
Route::group([
    'middleware' => 'api',
    'prefix' => 'produtos'
], function ($router) {
    Route::get('/', [ProdutosController::class, 'index']);
    Route::post('/create', [ProdutosController::class, 'create']);
    Route::post('/update', [ProdutosController::class, 'update']);
    Route::post('/delete', [ProdutosController::class, 'delete']);
});

//For Marcas
Route::group([
    'middleware' => 'api',
    'prefix' => 'marcas'
], function ($router) {
    Route::get('/', [MarcaController::class, 'index']);
    Route::post('/create', [MarcaController::class, 'create']);
    Route::post('/update', [MarcaController::class, 'update']);
    Route::post('/delete', [MarcaController::class, 'delete']);
});

//For Categorias
Route::group([
    'middleware' => 'api',
    'prefix' => 'categorias'
], function ($router) {
    Route::get('/', [CategoriaController::class, 'index']);
    Route::post('/create', [CategoriaController::class, 'create']);
    Route::post('/update', [CategoriaController::class, 'update']);
    Route::post('/delete', [CategoriaController::class, 'delete']);
});

//For Moedas
Route::group([
    'middleware' => 'api',
    'prefix' => 'moedas'
], function ($router) {
    Route::get('/', [MoedaController::class, 'index']);
    Route::post('/create', [MoedaController::class, 'create']);
    Route::post('/update', [MoedaController::class, 'update']);
    Route::post('/delete', [MoedaController::class, 'delete']);
});
