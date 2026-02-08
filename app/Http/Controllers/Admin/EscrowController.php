<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escrow;

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
        // proteksi status
        if ($escrow->status !== 'ready') {
            return back()->with('error', 'Escrow belum siap dicairkan');
        }

        // update escrow
        $escrow->update([
            'status' => 'released',
        ]);

        // pastikan order completed
        if ($escrow->order) {
            $escrow->order->update([
                'status' => 'completed',
            ]);
        }

        return back()->with('success', 'Dana berhasil dicairkan ke penjual');
    }
}
