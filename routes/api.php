<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\MonedaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\UnidadController;
use App\Models\Moneda;
use App\Models\Unidad;
use App\Models\Unidad_medida;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('clientes', ClienteController::class);
Route::apiResource('productos', ProductoController::class);
// Route::get('productos/buscar/{codigo}', [ProductoController::class, 'findByCodigo']);
Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('marcas', MarcaController::class);
Route::apiResource('unidades', UnidadController::class);
Route::apiResource('monedas', MonedaController::class);
Route::apiResource('proveedores', ProveedorController::class);
Route::apiResource('empresas', EmpresaController::class);
Route::apiResource('sucursales', SucursalController::class);
Route::apiResource('compras', CompraController::class);



// Route::get('/productos', function(){
//     return 'products list';
// });
