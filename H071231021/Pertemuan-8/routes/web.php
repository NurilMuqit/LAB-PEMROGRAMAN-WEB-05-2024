<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    $nama = 'Restu Ahmadinata';
    $istri = 'Mirai Kuriyama';
    return view('about', compact('nama', 'istri'));
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
