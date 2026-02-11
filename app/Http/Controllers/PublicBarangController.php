<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;

class PublicBarangController extends Controller
{
    public function show(Barang $barang)
    {
        if ($barang->status !== 'tersedia') {
            abort(404);
        }

        $barang->load([
            'images',
            'penjual:id,name,latitude,longitude'
        ]);

        $images = $barang->images->count()
            ? $barang->images
                ->map(fn ($img) => asset('storage/' . $img->image_path))
                ->toArray()
            : [asset('images/placeholder-product.jpg')];

        $product = [
            'id' => $barang->id,
            'name' => $barang->nama_barang,
            'description' => $barang->deskripsi,
            'price' => $barang->harga,
            'location' => 'Lokasi Penjual', // ⬅️ supaya Blade tidak error
            'images' => $images,
            'user' => [
                'id' => $barang->penjual->id,
                'name' => $barang->penjual->name,
                'avatar' => $barang->penjual->avatar
                    ? asset('storage/' . $barang->penjual->avatar)
                    : asset('images/avatar-placeholder.png'),
                'latitude' => $barang->penjual->latitude,
                'longitude' => $barang->penjual->longitude,
            ],
        ];

        return view('public.barang.show', [
            'product' => $product,
            'ratings' => [],
        ]);
        
    }

public function byKategori($id)
{
    $kategori = Kategori::findOrFail($id);

    $products = Barang::public()
        ->where('kategori_id', $kategori->id)
        ->with(['penjual', 'images'])
        ->latest()
        ->paginate(12);

    return view('produk.index', compact('products', 'kategori'));
}

}
