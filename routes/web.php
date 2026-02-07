<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    ChatController,
    BarangController,
    SellerController,
    ProfileController,
    PublicBarangController,
    PublicProfileController
};
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Buyer\{
    CheckoutController,
    BuyerOrderController,
    BuyerPaymentController
};
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Admin\{
    AdminDashboardController,
    EscrowController
};

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::view('/bantuan', 'pages.bantuan');
Route::view('/bantuan/cara-berbelanja', 'pages.cara-berbelanja');
Route::view('/bantuan/cara-berjualan', 'pages.cara-berjualan');
Route::view('/bantuan/metode-pembayaran', 'pages.metode-pembayaran');

Route::view('/tentang', 'pages.tentang');
Route::view('/syarat-ketentuan', 'pages.syarat-ketentuan');
Route::view('/kebijakan-privasi', 'pages.kebijakan-privasi');

/* Public Products */
Route::get('/products', [PublicBarangController::class, 'index'])
    ->name('products.index');

Route::get('/products/{barang}', [PublicBarangController::class, 'show'])
    ->name('products.show');

/* Public Profile */
Route::get('/users/{user}', [PublicProfileController::class, 'show'])
    ->name('public.profile');

Route::get('/users/{user}/products', [PublicProfileController::class, 'products'])
    ->name('public.profile.products');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/* Google Auth */
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])
    ->name('google.callback');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /* Profile */
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* Become Seller */
    Route::post('/become-seller', [SellerController::class, 'activate'])
        ->name('seller.activate');

    /* Chat */
    Route::post('/chat/start/{barang}', [ChatController::class, 'start']);
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('/chats/{chat}/messages', [ChatController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| BUYER
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('profile/buyer')
    ->name('buyer.')
    ->group(function () {

        /* Checkout */
        Route::get('/checkout/{barang}', [CheckoutController::class, 'show'])
            ->name('checkout');
        Route::post('/checkout/{barang}', [CheckoutController::class, 'store'])
            ->name('checkout.store');

        /* Orders */
        Route::get('/pesanan', [BuyerOrderController::class, 'index'])
            ->name('orders');
        Route::get('/pesanan/{order}', [BuyerOrderController::class, 'show'])
            ->name('orders.detail');

        /* Payment */
        Route::get('/pesanan/{order}/bayar', [BuyerPaymentController::class, 'show'])
            ->name('orders.pay');
        Route::post('/pesanan/{order}/confirm-transfer', [BuyerPaymentController::class, 'confirmTransfer'])
            ->name('orders.confirmTransfer');

        /* Confirm Order */
        Route::post('/pesanan/{order}/confirm', [BuyerOrderController::class, 'confirm'])
            ->name('orders.confirm');
    });

/*
|--------------------------------------------------------------------------
| SELLER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'seller'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {

        /* Products */
        Route::get('/products', [BarangController::class, 'sellerIndex'])->name('products');
        Route::get('/products/create', [BarangController::class, 'create'])->name('products.create');
        Route::post('/products', [BarangController::class, 'store'])->name('products.store');
        Route::get('/products/{barang}', [BarangController::class, 'sellerShow'])->name('products.show');
        Route::get('/products/{id}/edit', [BarangController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [BarangController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [BarangController::class, 'destroy'])->name('products.destroy');
        Route::delete('/products/image/{id}', [BarangController::class, 'deleteImage'])
            ->name('products.image.delete');

        /* Orders */
        Route::get('/orders', [SellerOrderController::class, 'index'])->name('orders');
        Route::get('/orders/{order}', [SellerOrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{order}/accept', [SellerOrderController::class, 'accept'])->name('orders.accept');
        Route::post('/orders/{order}/ship', [SellerOrderController::class, 'ship'])->name('orders.ship');

        /* Statistics */
        Route::get('/statistics', [SellerController::class, 'statistics'])->name('statistics');
    });

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        /* Escrow */
        Route::get('/escrows', [EscrowController::class, 'index'])
            ->name('escrows.index');

        Route::post('/escrows/{escrow}/verify', [EscrowController::class, 'verify'])
            ->name('escrows.verify');

        Route::post('/escrows/{escrow}/release', [EscrowController::class, 'release'])
            ->name('escrows.release');
    });
