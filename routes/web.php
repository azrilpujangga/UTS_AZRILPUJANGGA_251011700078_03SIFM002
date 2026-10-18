<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtworkController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/gallery', [ArtworkController::class, 'index'])
    ->name('artworks.index');

Route::get('/gallery/{id}', [ArtworkController::class, 'show'])
    ->name('artworks.show');

Route::get('/about', function () {
    return view('about');
})->name('about');
