<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryLogController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/category',[CategoryController::class,'index'])->name('readCategory');
Route::post('/category',[CategoryController::class,'store'])->name('createCategory');
Route::delete('/category/{id}',[CategoryController::class,'destroy'])->name('deleteCategory');
Route::post('/category/{id}',[CategoryController::class,'update'])->name('updateCategory');

Route::get('/product', [ProductController::class, 'index'])->name('readProduct');
Route::post('/product', [ProductController::class, 'store'])->name('createProduct');
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('deleteProduct');
Route::post('/product/{id}', [ProductController::class, 'update'])->name('updateProduct');
Route::get('/products', [ProductController::class, 'index'])->name('product.index');

Route::get('/inventoryLog', [InventoryLogController::class, 'index'])->name('readInventoryLog');
Route::post('/inventoryLog', [InventoryLogController::class, 'store'])->name('createInventoryLog');
Route::post('/inventoryLog/{id}', [InventoryLogController::class, 'update'])->name('updateInventoryLog');
Route::delete('/inventoryLog/{id}', [InventoryLogController::class, 'destroy'])->name('deleteInventoryLog');
