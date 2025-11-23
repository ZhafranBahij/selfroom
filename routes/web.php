<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin');

// Keep the welcome route for reference or testing if needed
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
