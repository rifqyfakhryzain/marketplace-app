<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Escrow;

class BuyerPaymentController extends Controller
{
    public function show(Order $order)
    {
        // pastikan relasi barang ikut kebawa
        $order->load('barang');

        // escrow wajib ada
        $escrow = Escrow::where('order_id', $order->id)->firstOrFail();

        return view('profile.buyer.bayar', [
            'order'  => $order,
            'escrow' => $escrow,
        ]);
    }
}
