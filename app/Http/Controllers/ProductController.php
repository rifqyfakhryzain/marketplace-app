<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = [
            'id' => $id,
            'name' => 'Kursi Sekolah Kayu',
            'price' => 320000,
            'location' => 'Jakarta Selatan',
            'images' => [
                '/img/produk1.jpg',
                '/img/produk2.jpg',
                '/img/produk3.jpg',
            ],
            'description' => "Kursi sekolah kayu solid.\nKondisi masih sangat baik.\nSiap pakai, kokoh dan awet. bisa di pakai untuk belajar \natau keperluan lainnya.\nCocok untuk anak usia sekolah dasar hingga menengah.",
            'user' => [
                'id' => 1,
                'name' => 'Dadang Gendang',
                'avatar' => '/img/avatar.jpg',
            ],
        ];

        $ratings = [
        [
            'initial' => 'R*** S***',
            'star' => 4.5,
            'product' => 'Kursi Sekolah Kayu',
            'comment' => 'Barang sesuai deskripsi, kondisi masih bagus.',
        ],
        [
            'initial' => 'A*** W***',
            'star' => 5,
            'product' => 'Meja Belajar',
            'comment' => 'Penjual ramah dan pengiriman cepat.',
        ],
        [
            'initial' => 'D*** P***',
            'star' => 3.5,
            'product' => 'Rak Buku',
            'comment' => 'Barang oke, tapi pengiriman agak lama.',
        ],
    ];

    return view('produk.show', compact('product', 'ratings'));


        return view('produk.show', compact('product'));
    }
}
