<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class PublicBarangController extends Controller
{
    public function show(Barang $barang)
    {
        if ($barang->status !== 'tersedia') {
            abort(404);
        }

        $barang->load(['images', 'penjual']);

        $images = $barang->images->count()
            ? $barang->images
            ->map(fn($img) => asset('storage/' . $img->image_path))
            ->toArray()
            : [asset('images/placeholder-product.jpg')];

        $product = [
            'id' => $barang->id,
            'name' => $barang->nama_barang,
            'description' => $barang->deskripsi,
            'price' => $barang->harga,
            'location' => 'Indonesia',
            'images' => $images,
            'user' => [
                'id' => $barang->penjual->id,
                'name' => $barang->penjual->name,
                'username' => $barang->penjual->username,
                'avatar' => asset('images/avatar-placeholder.png'),
            ],
        ];

        return view('public.barang.show', [
            'product' => $product,
            'ratings' => [],
        ]);
    }
}
