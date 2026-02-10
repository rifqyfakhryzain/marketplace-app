<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class SellerOrderController extends Controller
{
    // LIST PESANAN SELLER
    public function index()
    {
        $orders = Order::with(['barang'])
            ->where('seller_id', Auth::id())
            ->latest()
            ->get();

        return view('seller.pesanan', compact('orders'));
    }

    // DETAIL PESANAN
    public function show(Order $order)
    {
        abort_if($order->seller_id !== Auth::id(), 403);

        $order->load(['barang', 'buyer', 'escrow']);

        return view('seller.detail-pesanan', compact('order'));
    }
}
