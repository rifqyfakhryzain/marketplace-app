<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\EscrowController;
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
| DEFAULT AUTH (BREEZE)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| BACKEND - BARANG
|--------------------------------------------------------------------------
*/

Route::get('/barang', [BarangController::class, 'index']);
Route::get('/barang/{id}', [BarangController::class, 'show']);
Route::put('/barang/{id}', [BarangController::class, 'update']);
Route::delete('/barang/{id}', [BarangController::class, 'destroy']);


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
| CHAT
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::post('/chat/start/{barang}', [ChatController::class, 'start']);
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('/chats/{chat}/messages', [ChatController::class, 'store']);
});
