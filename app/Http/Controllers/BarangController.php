<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
public function index()
{
    $barangs = Barang::latest()->get();
    return view('home', compact('barangs'));
}


public function show($id)
{
    $barang = Barang::with('penjual')->findOrFail($id);

    $product = [
        'id' => $barang->id,
        'name' => $barang->nama_barang,
        'description' => $barang->deskripsi,
        'price' => $barang->harga,
        'location' => 'Indonesia', // atau dari DB nanti

        // sementara dummy / nanti dari relasi gambar
        'images' => [
            '/images/dummy1.jpg',
            '/images/dummy2.jpg',
        ],

        'user' => [
            'id' => $barang->penjual?->id,
            'name' => $barang->penjual?->name,
            'avatar' => $barang->penjual?->avatar ?? '/images/default-avatar.png',
        ],
    ];

    // dummy ratings (karena FE expect ini)
    $ratings = [
        [
            'initial' => 'AR',
            'star' => 5,
            'product' => $product['name'],
            'comment' => 'Barang sesuai deskripsi, pengiriman cepat',
        ],
    ];

    return view('produk.show', compact('product', 'ratings'));
}





    public function update(Request $request, $id)
    {
        $barang = \App\Models\Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang tidak ditemukan'], 404);
        }

        $barang->update($request->all());

        return $barang;
    }

    public function destroy($id)
    {
        $barang = \App\Models\Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang tidak ditemukan'], 404);
        }

        $barang->delete();

        return response()->json(['message' => 'Barang berhasil dihapus']);
    }



}
