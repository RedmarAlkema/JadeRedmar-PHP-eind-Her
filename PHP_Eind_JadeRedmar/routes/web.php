<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\AdvertisementController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
    Route::post('/favorite/{id}', [FavoritesController::class, 'favorite'])->name('favorite');
    Route::post('/unfavorite/{id}', [FavoritesController::class, 'unfavorite'])->name('unfavorite');   

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/advertisement/{id}', [AdvertisementController::class, 'show'])->name('advertisement');


});
