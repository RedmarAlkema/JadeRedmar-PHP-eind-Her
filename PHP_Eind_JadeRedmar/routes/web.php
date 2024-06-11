<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\UserAgendaController;
use App\Http\Controllers\AdminContractController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::put('/dashboard', [DashboardController::class, 'update'])->name('dashboard.update');

    Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
    Route::post('/favorite/{id}', [FavoritesController::class, 'favorite'])->name('favorite');
    Route::post('/unfavorite/{id}', [FavoritesController::class, 'unfavorite'])->name('unfavorite');   

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/advertisement/{id}', [AdvertisementController::class, 'show'])->name('advertisement');
    Route::get('/advertisements/create', [AdvertisementController::class, 'create'])->name('advertisements.create');
    Route::post('/advertisements', [AdvertisementController::class, 'store'])->name('advertisements.store');

    Route::get('/review/seller', [ReviewController::class, 'postSellerReview'])->name('review.seller');
    Route::post('/review/advertisement', [ReviewController::class, 'postAdvertisementReview'])->name('review.advertisement');
    Route::post('/review/{advertisement}', [ReviewController::class, 'store'])->name('review.store');

    Route::post('/cart/add/{advertisement}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
    Route::post('/cart/remove/{item}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'purchaseItems'])->name('cart.checkout');
    Route::get('/history', [CartController::class, 'purchaseHistory'])->name('history');

    
    Route::get('/seller/{id}', [SellerController::class, 'show'])->name('seller.show.id');
    Route::get('/seller/custom/{custom_url}', [SellerController::class, 'showByCustomUrl'])->name('seller.show.custom');
    Route::post('/seller/review', [ReviewController::class, 'postSellerReview'])->name('seller.review');

    Route::get('/agenda', [AgendaController::class, 'index'])->name('dashboard.agenda');
    Route::get('/user-agenda', [UserAgendaController::class, 'index'])->name('user-agenda');
    
    
    Route::get('/contracts', [AdminContractController::class, 'index'])->name('contracts.index');
    Route::patch('/contracts/{id}/approve', [AdminContractController::class, 'approve'])->name('contracts.approve');
    Route::patch('/contracts/{id}/reject', [AdminContractController::class, 'reject'])->name('contracts.reject');
    Route::get('/contracts/download/{id}', [AdminContractController::class, 'download'])->name('contracts.download');


    Route::post('/contracts/upload', [ContractController::class, 'upload'])->name('contracts.upload');


});

