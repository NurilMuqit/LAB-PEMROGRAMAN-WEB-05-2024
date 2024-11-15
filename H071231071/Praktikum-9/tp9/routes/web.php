<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\InventoryLogsController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/categories', CategoriesController::class);
Route::resource('/products', ProductsController::class);
Route::resource('/inventoryLogs', InventoryLogsController::class);