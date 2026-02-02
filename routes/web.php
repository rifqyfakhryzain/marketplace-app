<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\EscrowController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicBarangController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/

// Route::view('/', 'home')->name('home');
Route::get('/',[HomeController::class, 'index'])->name('home');

// Route::view('/produk/{id}', 'product-detail')->name('produk.detail');

Route::view('/bantuan', 'pages.bantuan');
Route::view('/bantuan/cara-berbelanja', 'pages.cara-berbelanja');
Route::view('/bantuan/cara-berjualan', 'pages.cara-berjualan');
Route::view('/bantuan/metode-pembayaran', 'pages.metode-pembayaran');

Route::view('/tentang', 'pages.tentang');
Route::view('/syarat-ketentuan', 'pages.syarat-ketentuan');
Route::view('/kebijakan-privasi', 'pages.kebijakan-privasi');

// Public Product
Route::get('/products', [PublicBarangController::class, 'index'])
    ->name('products.index');

Route::get('/products/{barang}', [PublicBarangController::class, 'show'])
    ->name('products.show');
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

Route::get('/seller/orders/{order}', function ($order) {
    return view('profile.seller.detailPesanan');
})->name('seller.orders.detail');

Route::middleware(['auth'])->group(function () {

    // LIST PESANAN BUYER
    Route::get('/profile/buyer/pesanan', function () {
        return view('profile.buyer.pesanan');
    })->name('buyer.orders');

    // DETAIL PESANAN BUYER
    Route::get('/profile/buyer/pesanan/{id}', function ($id) {
        return view('profile.buyer.detailPesanan', compact('id'));
    })->name('buyer.orders.detail');

    // ✅ BAYAR SEKARANG (ESCROW)
    Route::get('/profile/buyer/pesanan/{id}/bayar', function ($id) {
        return view('profile.buyer.Bayar', compact('id'));
    })->name('buyer.orders.pay');

});


Route::middleware(['auth'])->group(function () {

    // LIST PESANAN SELLER
    Route::get('/profile/seller/pesanan', function () {
        return view('profile.seller.pesanan');
    })->name('seller.orders');

    // DETAIL PESANAN SELLER
    Route::get('/profile/seller/pesanan/{id}', function ($id) {
        return view('profile.seller.detailPesanan', compact('id'));
    })->name('seller.orders.detail');

});