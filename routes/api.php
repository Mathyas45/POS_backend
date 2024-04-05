<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('clientes', ClienteController::class);
Route::apiResource('productos', ProductoController::class);
Route::get('productos/buscar/{codigo}', [ProductoController::class, 'findByCodigo']);
Route::apiResource('categorias', CategoriaController::class);

// Route::get('/productos', function(){
//     return 'products list';
// });
