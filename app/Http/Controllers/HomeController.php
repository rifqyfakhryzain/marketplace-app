<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // index
    public function index()
    {
        $products = Barang::public()
        ->with('penjual')
        ->latest()
        ->take(10)
        ->get()
        ->map(function ($barang)
        {
            return [
                'id' => $barang->id,
                'name' => $barang->nama_barang,
                'price' => $barang->harga,
                'location' => $barang->penjual->profile->alamat ?? 'indonesia',
                'image' => asset('image/placeholder-product.jpg'),
            ];
        });
        
        return view('home', compact('products'));
    }
}
