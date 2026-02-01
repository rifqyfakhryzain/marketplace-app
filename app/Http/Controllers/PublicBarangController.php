<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class PublicBarangController extends Controller
{
public function show(Barang $barang)
{
    // Proteksi barang nonaktif
    if ($barang->status !== 'tersedia') {
        abort(404);
    }

    $product = [
        'id' => $barang->id,
        'name' => $barang->nama_barang,
        'description' => $barang->deskripsi,
        'price' => $barang->harga,
        'location' => $barang->penjual->profile->alamat ?? 'Indonesia',
        'images' => [
            asset('images/placeholder-product.jpg'),
        ],
        'user' => [
            'id' => $barang->penjual->id,
            'name' => $barang->penjual->name,
            'avatar' => asset('images/avatar-placeholder.png'),
        ],
    ];

    return view('public.barang.show', [
        'product' => $product,   
        'ratings' => [],
    ]);
}

}
