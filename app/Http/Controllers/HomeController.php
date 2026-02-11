<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // index
public function index()
{
    $categories = Kategori::all();

    $products = Barang::public()
        ->with(['penjual', 'images', 'kategori'])
        ->latest()
        ->take(10)
        ->get();

    $rekomendasi = Barang::public()
        ->with(['penjual', 'images'])
        ->inRandomOrder()
        ->take(8)
        ->get();

    return view('home', compact('products', 'rekomendasi', 'categories'));
}

public function filterKategori($id)
{
    $categories = Kategori::all();

    $products = Barang::public()
        ->where('kategori_id', $id)
        ->with(['penjual', 'images', 'kategori'])
        ->latest()
        ->get();

    $rekomendasi = Barang::public()
        ->where('kategori_id', $id) // 🔥 TAMBAH INI
        ->with(['penjual', 'images'])
        ->inRandomOrder()
        ->take(8)
        ->get();

    return view('home', compact('products', 'rekomendasi', 'categories'));
}


}
