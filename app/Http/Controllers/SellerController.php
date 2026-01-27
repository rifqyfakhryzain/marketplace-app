<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function products()
    {
        return view('profile.seller.produksaya');
    }

    public function orders()
    {
        return view('profile.seller.pesanan');
    }

    public function statistics()
    {
        return view('profile.seller.statistik');
    }

    public function createProduct()
    {
        return view('profile.seller.tambahproduk');
    }
}
