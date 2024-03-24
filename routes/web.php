<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', App\Http\Controllers\UserController::class);
Route::resource('categories', App\Http\Controllers\CategoryController::class);
Route::resource('products', App\Http\Controllers\ProductController::class);
Route::resource('product-variations', App\Http\Controllers\ProductVariationController::class);
Route::resource('product-variation-attributes', App\Http\Controllers\ProductVariationAttributeController::class);
Route::resource('product-variation-photos', App\Http\Controllers\ProductVariationPhotoController::class);
Route::resource('product-categories', App\Http\Controllers\ProductCategoryController::class);
Route::resource('attributes', App\Http\Controllers\AttributeController::class);
Route::resource('options', App\Http\Controllers\OptionController::class);
Route::resource('clients', App\Http\Controllers\ClientController::class);
Route::resource('stores', App\Http\Controllers\StoreController::class);
Route::resource('store-products', App\Http\Controllers\StoreProductController::class);
Route::resource('orders', App\Http\Controllers\OrderController::class);
Route::resource('order-products', App\Http\Controllers\OrderProductController::class);
Route::resource('order-statuses', App\Http\Controllers\OrderStatusController::class);
Route::resource('order-status-changes', App\Http\Controllers\OrderStatusChangeController::class);