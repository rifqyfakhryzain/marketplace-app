<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Order;
use App\Models\Escrow;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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

    public function confirmTransfer(Order $order)
    {
        DB::transaction(function () use ($order) {

            // ambil escrow (WAJIB ADA)
            $escrow = $order->escrow;

            if (!$escrow) {
                abort(404, 'Escrow tidak ditemukan');
            }

            // update escrow
            $escrow->update([
                'status' => 'waiting_verification',
            ]);

            // update order
            $order->update([
                'status' => 'waiting_verification',
            ]);
        });

        return redirect()
            ->route('buyer.orders.pay', $order->id)
            ->with('success', 'Konfirmasi transfer berhasil. Menunggu verifikasi admin.');
    }
}
