<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleAuthController;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/

Route::view('/', 'home')->name('home');

Route::view('/produk/{id}', 'product-detail')->name('produk.detail');
Route::view('/pesanan', 'pesanan')->middleware('auth')->name('pesanan');

Route::view('/bantuan', 'pages.bantuan');
Route::view('/bantuan/cara-berbelanja', 'pages.cara-berbelanja');
Route::view('/bantuan/cara-berjualan', 'pages.cara-berjualan');
Route::view('/bantuan/metode-pembayaran', 'pages.metode-pembayaran');

Route::view('/tentang', 'pages.tentang');
Route::view('/syarat-ketentuan', 'pages.syarat-ketentuan');
Route::view('/kebijakan-privasi', 'pages.kebijakan-privasi');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| GOOGLE AUTH
|--------------------------------------------------------------------------
*/

Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])
    ->name('google.callback');

/*
|--------------------------------------------------------------------------
| DEFAULT AUTH (BREEZE)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
