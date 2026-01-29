<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
    $barang = Barang::findOrFail($id);

    // CEGAH EDIT BARANG ORANG LAIN
if ($barang->user_id !== Auth::id()) {
        abort(403, 'Tidak diizinkan');
    }

    $validated = $request->validate([
        'nama_barang' => 'required|string|max:255',
        'deskripsi'   => 'nullable|string',
        'harga'       => 'required|integer|min:0',
        'kategori_id' => 'required|exists:kategori,id',
        'status'      => 'required|string',
    ]);

    $barang->update($validated);

    return redirect()->route('seller.products')
        ->with('success', 'Produk berhasil diperbarui');
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
