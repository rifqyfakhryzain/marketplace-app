<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\EscrowController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleAuthController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/

Route::view('/', 'home')->name('home');

// Route::view('/produk/{id}', 'product-detail')->name('produk.detail');

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

    Route::view('/pesanan', 'pesanan')->name('pesanan');
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
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
| ESCROW (AUTHENTICATED)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::post('/escrow', [EscrowController::class, 'createEscrow'])
        ->name('escrow.create');

    Route::post('/escrow/{id}/approve', [EscrowController::class, 'approveEscrow'])
        ->name('escrow.approve');

    Route::post('/escrow/{id}/reject', [EscrowController::class, 'rejectEscrow'])
        ->name('escrow.reject');
});

/*
|--------------------------------------------------------------------------
| CHAT (AUTHENTICATED)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::post('/chat/start/{barang}', [ChatController::class, 'start']);
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('/chats/{chat}/messages', [ChatController::class, 'store']);
});


/*
|--------------------------------------------------------------------------
| DEFAULT AUTH (BREEZE)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

// AKTIFKAN TOKO (BUYER -> SELLER)
Route::post('/become-seller', [SellerController::class, 'activate'])
    ->middleware('auth')
    ->name('seller.activate');

Route::middleware(['auth', 'seller'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {

        // ✅ PRODUK SELLER (KE BarangController)
        Route::get('/products', [BarangController::class, 'sellerIndex'])
            ->name('products');

        Route::get('/products/create', [BarangController::class, 'create'])
            ->name('products.create');

        Route::post('/products', [BarangController::class, 'store'])
            ->name('products.store');


        // Lihat
        Route::get('/products/{barang}', [BarangController::class, 'sellerShow'])
            ->name('products.show');
        // 🔹 EDIT
        Route::get('/products/{id}/edit', [BarangController::class, 'edit'])
            ->name('products.edit');

        // 🔹 UPDATE
        Route::put('/products/{id}', [BarangController::class, 'update'])
            ->name('products.update');

        // 🔹 DELETE
        Route::delete('/products/{id}', [BarangController::class, 'destroy'])
            ->name('products.destroy');

        // Pesanan masuk
        Route::get('/orders', [SellerController::class, 'orders'])
            ->name('orders');

        // Statistik penjualan
        Route::get('/statistics', [SellerController::class, 'statistics'])
            ->name('statistics');
    });
