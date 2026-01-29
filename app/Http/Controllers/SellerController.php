<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class SellerController extends Controller
{
    // 🔹 BUYER -> SELLER
public function activate(): RedirectResponse
{
    $user = Auth::user();

    if (! $user->hasRole('seller')) {
        $user->assignRole('seller');
    }

    return redirect()->route('profile.show')
        ->with('success', 'Toko berhasil diaktifkan');
}

    // 🔹 LIST PRODUK SELLER
    public function products()
    {
$products = Auth::user()->barangs;        return view('profile.seller.produksaya', compact('products'));
    }

    // 🔹 FORM TAMBAH PRODUK
    public function createProduct()
    {
        return view('profile.seller.tambahproduk');
    }

    // 🔹 SIMPAN PRODUK
    public function storeProduct(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        Barang::create([
'user_id' => Auth::id(), // SELLER
            'nama'      => $request->nama,
            'harga'     => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('seller.products')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    // 🔹 PESANAN MASUK
    public function orders()
    {
$orders = Auth::user()->ordersAsSeller;
        return view('profile.seller.pesanan', compact('orders'));
    }

    // 🔹 STATISTIK
    public function statistics()
    {
        return view('profile.seller.statistik');
    }
}
