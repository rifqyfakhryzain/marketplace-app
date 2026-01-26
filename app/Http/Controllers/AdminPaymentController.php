<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use App\Models\Wallet;
use App\Services\WalletService;

class AdminPaymentController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['role:admin']);
    // }

    // Admin approve pembayaran (manual transfer)
    public function approve($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        $order = Order::findOrFail($payment->order_id);

        // update status
        $payment->update(['status' => 'approved']);
        $order->update(['status' => 'paid']);

        // hold escrow
        $buyerWallet = Wallet::where('user_id', $order->buyer_id)->first();
        app(WalletService::class)->hold(
            $buyerWallet,
            $order->total_price,
            'Pembayaran Order #'.$order->id,
            $order->id
        );

        return back()->with('success', 'Pembayaran disetujui & dana di-hold');
    }

    // Admin selesaikan order → cairkan escrow
    public function release($orderId)
    {
        $order = Order::findOrFail($orderId);

        $sellerWallet = Wallet::where('user_id', $order->seller_id)->first();
        app(WalletService::class)->release(
            $sellerWallet,
            $order->total_price,
            'Pencairan Order #'.$order->id,
            $order->id
        );

        $order->update(['status' => 'completed']);

        return back()->with('success', 'Dana escrow dicairkan');
    }
}
