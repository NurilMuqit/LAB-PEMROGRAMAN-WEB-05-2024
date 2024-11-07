<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;


Route::get('/', [NotificationController::class, 'home'])->name('home');
Route::get('/about', [NotificationController::class, 'about'])->name('about');
Route::get('/contact', [NotificationController::class, 'contact'])->name('contact');

