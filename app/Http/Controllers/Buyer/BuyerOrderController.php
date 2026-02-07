<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerOrderController extends Controller
{
    // LIST PESANAN
public function index(Request $request)
{
    $query = Order::with(['barang.images'])
        ->where('buyer_id', Auth::id())
        ->latest();

    if ($request->status) {
        match ($request->status) {
            'pending' => $query->where('status', 'pending'),

            'processed' => $query->whereIn('status', [
                'waiting_verification',
                'processed',
            ]),

            'shipped' => $query->where('status', 'shipped'),

            'completed' => $query->where('status', 'completed'),

            default => null,
        };
    }

    $orders = $query->get();

    return view('profile.buyer.pesanan', compact('orders'));
}


    // DETAIL PESANAN
    public function show(Order $order)
    {
        // proteksi: pesanan bukan milik user
        abort_if($order->buyer_id !== Auth::id(), 403);

        // eager load relasi
        $order->load([
            'barang.images',
            'escrow',
        ]);

      
        return view('profile.buyer.detail-pesanan', compact('order'));
    }
}
