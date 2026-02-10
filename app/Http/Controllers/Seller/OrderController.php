<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with([
            'buyer',
            'barang.images',
            'escrow',
        ])
            ->where('seller_id', Auth::id())
            ->latest()
            ->get();

        return view('profile.seller.pesanan', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_if($order->seller_id !== Auth::id(), 403);

        $order->load([
            'buyer',
            'barang.images',
            'escrow',
        ]);

        return view('profile.seller.detail-pesanan', compact('order'));
    }

    public function accept(Order $order)
    {
        abort_if($order->seller_id !== Auth::id(), 403);

        if ($order->status !== 'processed') {
            return back()->with('error', 'Pesanan tidak bisa diterima.');
        }

        $order->update([
            'status' => 'processing',
        ]);

        return redirect()
            ->route('seller.orders.show', $order->id)
            ->with('success', 'Pesanan berhasil diterima.');
    }

    public function ship(Order $order)
    {
        abort_if($order->seller_id !== Auth::id(), 403);

        if ($order->status !== 'processing') {
            return back()->with('error', 'Pesanan belum siap dikirim.');
        }

        $order->update([
            'status' => 'shipped',
        ]);

        return redirect()
            ->route('seller.orders.show', $order->id)
            ->with('success', 'Pesanan berhasil dikirim.');
    }
}
