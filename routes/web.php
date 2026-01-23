<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
    
});

Route::get('/produk/{id}', function ($id) {
    return view('product-detail', ['id' => $id]);
});

Route::get('/pesanan', function () {
    return view('pesanan');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/bantuan', fn () => view('pages.bantuan'));
Route::get('/bantuan/cara-berbelanja', fn () => view('pages.cara-berbelanja'));
Route::get('/bantuan/cara-berjualan', fn () => view('pages.cara-berjualan'));
Route::get('/bantuan/metode-pembayaran', fn () => view('pages.metode-pembayaran'));

Route::get('/tentang', fn () => view('pages.tentang'));
Route::get('/syarat-ketentuan', fn () => view('pages.syarat-ketentuan'));
Route::get('/kebijakan-privasi', fn () => view('pages.kebijakan-privasi'));
