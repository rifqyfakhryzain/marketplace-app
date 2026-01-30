<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class SellerController extends Controller
{
    /**
     * =================================
     * BUYER -> SELLER (AKTIVASI TOKO)
     * =================================
     */
    public function activate(): RedirectResponse
    {
        $user = Auth::user();

        if (! $user->hasRole('seller')) {
            $user->assignRole('seller');
        }

        return redirect()
            ->route('profile.show')
            ->with('success', 'Toko berhasil diaktifkan');
    }

    /**
     * =========================
     * SELLER - PESANAN MASUK
     * =========================
     */
    public function orders()
    {
        $orders = Auth::user()->ordersAsSeller;

        return view('profile.seller.pesanan', compact('orders'));
    }

    /**
     * =========================
     * SELLER - STATISTIK
     * =========================
     */
    public function statistics()
    {
        return view('profile.seller.statistik');
    }
}
