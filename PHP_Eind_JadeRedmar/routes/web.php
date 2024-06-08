<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SellerController;

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

    Route::get('/review/seller', [ReviewController::class, 'postSellerReview'])->name('review.seller');
    Route::post('/review/advertisement', [ReviewController::class, 'postAdvertisementReview'])->name('review.advertisement');
    Route::post('/review/{advertisement}', [ReviewController::class, 'store'])->name('review.store');

    Route::post('/cart/add/{advertisement}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
    Route::post('/cart/remove/{item}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'purchaseItems'])->name('cart.checkout');
    Route::get('/history', [CartController::class, 'purchaseHistory'])->name('history');

    Route::get('/seller/{id}', [SellerController::class, 'show'])->name('seller.show');
    Route::post('/seller/review', [ReviewController::class, 'postSellerReview'])->name('seller.review');

});
