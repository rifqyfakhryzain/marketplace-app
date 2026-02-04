<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;

class PublicProfileController extends Controller
{
    // Pubblic Profile
    public function show(User $user)
    {
        return view('profile.public', compact('user'));
    }

    // Halaman liat barang lain
    public function products(User $user)
    {
        $products = Barang::where('user_id', $user->id)
        ->where('status', 'tersedia')
        ->latest()
        ->get();

        return view('profile.public-products', compact('user','products'));
    }
}
