<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        $sellerId = Auth::id();

        // ===============================
        // QUERY BASE ORDER SELLER
        // ===============================
        $orders = Order::where('seller_id', $sellerId);

        // ===============================
        // STATUS PESANAN
        // ===============================
        $pending   = (clone $orders)->where('status', 'pending')->count();
        $processed = (clone $orders)->where('status', 'processed')->count();
        $shipped   = (clone $orders)->where('status', 'shipped')->count();
        $completed = (clone $orders)->where('status', 'completed')->count();

        // ===============================
        // TOTAL
        // ===============================
        $totalOrders = (clone $orders)->count();

        $totalRevenue = (clone $orders)
            ->where('status', 'completed')
            ->sum('total_price');

        $totalItems = (clone $orders)
            ->where('status', 'completed')
            ->sum('qty');

        $activeProducts = Barang::where('user_id', $sellerId)->count();

        // ==========================
        // PRODUK TERLARIS
        // ==========================
        $topProducts = DB::table('barang')
            ->select(
                'barang.id',
                'barang.nama_barang',
                'barang.harga',
                DB::raw('SUM(orders.qty) as total_sold')
            )
            ->join('orders', 'barang.id', '=', 'orders.barang_id')
            ->where('orders.seller_id', $sellerId)
            ->where('orders.status', 'completed')
            ->groupBy('barang.id', 'barang.nama_barang', 'barang.harga')
            ->orderByDesc('total_sold')
            ->take(3)
            ->get();
        return view('profile.seller.statistik', compact(
            'pending',
            'processed',
            'shipped',
            'completed',
            'totalOrders',
            'totalRevenue',
            'totalItems',
            'activeProducts',
            'topProducts'
        ));
    }
}
