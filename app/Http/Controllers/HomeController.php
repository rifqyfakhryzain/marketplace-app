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
        ->with(['penjual', 'images'])
        ->latest()
        ->take(10)
        ->get();

    return view('home', compact('products'));
}


}
