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
            'seller_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric|min:1',
            'payment_method' => 'required|in:transfer_bank,cod',
        ]);

        abort_if(Auth::id() == $request->seller_id, 403);

        DB::transaction(function () use ($request) {
            $order = Order::create([
                'buyer_id' => Auth::id(),
                'seller_id' => $request->seller_id,
                'total_price' => $request->total_price,
                'status' => $request->payment_method === 'cod'
                    ? 'on_process'
                    : 'pending_payment',
            ]);

            Payment::create([
                'order_id' => $order->id,
                'method' => $request->payment_method,
                'status' => $request->payment_method === 'cod'
                    ? 'unpaid'
                    : 'pending',
            ]);
        });

        return redirect()->back()->with('success', 'Order berhasil dibuat');
    }
}
