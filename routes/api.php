<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('users', App\Http\Controllers\API\UserAPIController::class)
    ->except(['create', 'edit']);

Route::resource('categories', App\Http\Controllers\API\CategoryAPIController::class)
    ->except(['create', 'edit']);

Route::resource('products', App\Http\Controllers\API\ProductAPIController::class)
    ->except(['create', 'edit']);

Route::resource('product-variations', App\Http\Controllers\API\ProductVariationAPIController::class)
    ->except(['create', 'edit']);

Route::resource('product-variation-attributes', App\Http\Controllers\API\ProductVariationAttributeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('product-variation-photos', App\Http\Controllers\API\ProductVariationPhotoAPIController::class)
    ->except(['create', 'edit']);

Route::resource('product-categories', App\Http\Controllers\API\ProductCategoryAPIController::class)
    ->except(['create', 'edit']);

Route::resource('attributes', App\Http\Controllers\API\AttributeAPIController::class)
    ->except(['create', 'edit']);

Route::resource('options', App\Http\Controllers\API\OptionAPIController::class)
    ->except(['create', 'edit']);

Route::resource('clients', App\Http\Controllers\API\ClientAPIController::class)
    ->except(['create', 'edit']);

Route::resource('stores', App\Http\Controllers\API\StoreAPIController::class)
    ->except(['create', 'edit']);

Route::resource('store-products', App\Http\Controllers\API\StoreProductAPIController::class)
    ->except(['create', 'edit']);

Route::resource('orders', App\Http\Controllers\API\OrderAPIController::class)
    ->except(['create', 'edit']);

Route::resource('order-products', App\Http\Controllers\API\OrderProductAPIController::class)
    ->except(['create', 'edit']);

Route::resource('order-statuses', App\Http\Controllers\API\OrderStatusAPIController::class)
    ->except(['create', 'edit']);

Route::resource('order-status-changes', App\Http\Controllers\API\OrderStatusChangeAPIController::class)
    ->except(['create', 'edit']);