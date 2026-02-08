<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Escrow;

class AdminDashboardController extends Controller
{
    public function index()
    {
        /**
         * ============================
         * AMBIL DATA ESCROW + RELASI
         * ============================
         */
        $escrows = Escrow::with([
            'order.buyer',
            'order.barang.penjual',
        ])
            ->latest()
            ->get();

        /**
         * ============================
         * RINGKASAN ORDER
         * ============================
         */
        $totalOrders = Order::count();

        $completedOrders = Order::where('status', 'completed')->count();

        /**
         * ============================
         * RINGKASAN ESCROW
         * ============================
         */
        $escrowHolding = Escrow::where('status', 'holding')->sum('amount');

        $escrowReady = Escrow::where('status', 'ready')->sum('amount');

        $totalEscrowPending = Escrow::whereIn('status', ['holding', 'ready'])
            ->sum('amount');

        $totalReleased = Escrow::where('status', 'released')
            ->sum('amount');

        /**
         * ============================
         * KIRIM KE VIEW
         * ============================
         */
        return view('admin.dashboard', compact(
            'escrows',
            'totalOrders',
            'completedOrders',
            'escrowHolding',
            'escrowReady',
            'totalEscrowPending',
            'totalReleased'
        ));
    }
}
