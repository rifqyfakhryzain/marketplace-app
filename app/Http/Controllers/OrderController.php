<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'seller_id' => 'required|exists:,id',
            'total_price' => 'required|numeric|min::1',
            'payment_method' => 'required|in:transfer_bank,cod',
        ]);

        DB::transaction(function () use ($request) {
            // Buat Order
            $order = Order::create([
                'buyer_id' => auth::id(),
                'seller_id' => $request->seller_id,
                'total_price' => $request->total_price,
                'status' => $request->payment_method === 'cod'
                ? 'on_process'
                : 'pending_payment'
                
            ]);

            // Buat payment
            Payment::create([
                'order_id' => $order->id,
                'method' => $request->payment_method,
                'status' => $request->payment_method === 'cod'
                ? 'unpaid'
                : 'pending',
            ]);
        });
    }
}
