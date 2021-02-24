<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});

Route::apiResource('products', \App\Http\Controllers\API\ProductController::class);
Route::apiResource('categories', \App\Http\Controllers\API\CategoryController::class);
Route::apiResource('orders', \App\Http\Controllers\API\OrderController::class);

Route::post('login', [\App\Http\Controllers\API\LoginController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\API\LoginController::class, 'logout']);

Route::get('/new-orders', [\App\Http\Controllers\API\AdminController::class, 'newOrders']);
Route::get('/all-orders', [\App\Http\Controllers\API\AdminController::class, 'allOrders']);
Route::post('/show', [\App\Http\Controllers\API\AdminController::class, 'show']);
Route::post('/change', [\App\Http\Controllers\API\AdminController::class, 'changeStatus']);
