<?php

use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductMaterialController;
use App\Http\Controllers\Api\WarehouseController;
use Illuminate\Http\Request;
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

Route::prefix('products')->group(function () {
    Route::post('/store', [ProductController::class, 'store']);
    Route::post('/update/{id}', [ProductController::class, 'update']);
});

Route::prefix('materials')->group(function () {
    Route::post('/store', [MaterialController::class, 'store']);
    Route::post('/update/{id}', [MaterialController::class, 'update']);
});

Route::prefix('products-material')->group(function () {
    Route::post('/store', [ProductMaterialController::class, 'store']);
    Route::post('/update/{id}', [ProductMaterialController::class, 'update']);
});

Route::prefix('warehouses')->group(function () {
    Route::post('/store', [WarehouseController::class, 'store']);
    Route::get('/get-product-history', [WarehouseController::class, 'productHistory']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
