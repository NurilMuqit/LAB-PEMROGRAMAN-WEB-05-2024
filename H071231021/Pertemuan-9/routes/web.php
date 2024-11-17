<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryLogController;
use Illuminate\Support\Facades\Route;

// Redirect ke halaman daftar produk sebagai halaman utama
Route::get('/', function () {
    return redirect()->route('products.index');
});

// Kelompok route untuk manajemen inventory
Route::prefix('inventory')->group(function () {
    // Routes untuk produk
    Route::resource('products', ProductController::class)->except(['show']);

    // Routes untuk kategori
    Route::resource('categories', CategoryController::class)->except(['show']);

    // Routes untuk log perubahan stok
    Route::get('inventory-logs', [InventoryLogController::class, 'index'])->name('inventory_logs.index');
});
