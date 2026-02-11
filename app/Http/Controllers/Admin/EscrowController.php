<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escrow;
use Illuminate\Support\Facades\DB;
use App\Models\WalletTransaction;


class EscrowController extends Controller
{
    public function index()
    {
        $escrows = Escrow::with(['order.buyer'])
            ->where('status', 'waiting_verification')
            ->latest()
            ->get();

        return view('admin.escrows.index', compact('escrows'));
    }

    public function verify(Escrow $escrow)
    {
        // update escrow
        $escrow->update([
            'status' => 'holding',
        ]);

        // update order
        $escrow->order->update([
            'status' => 'processed',
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi');
    }

    public function release(Escrow $escrow)
    {
        if ($escrow->status !== 'ready') {
            return back()->with('error', 'Escrow belum siap dicairkan');
        }

        DB::transaction(function () use ($escrow) {

            $seller = $escrow->order->barang->penjual;
            $wallet = $seller->wallet;

            // Tambah saldo seller
            $wallet->increment('balance', $escrow->amount);

            // Catat transaksi wallet
            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'type' => 'credit',
                'amount' => $escrow->amount,
                'description' => 'Dana escrow dicairkan oleh admin'
            ]);

            // Update escrow
            $escrow->update([
                'status' => 'released',
            ]);

            // Update order
            $escrow->order->update([
                'status' => 'completed',
            ]);
        });

        return back()->with('success', 'Dana berhasil dicairkan ke penjual');
    }
}
