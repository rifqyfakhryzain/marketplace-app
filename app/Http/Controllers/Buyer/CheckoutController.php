<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Order;
use App\Models\Escrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    // tampilkan halaman checkout
    public function show(Barang $barang): View
    {
        $barang->load(['penjual', 'images']);

        $images = $barang->images->count()
            ? $barang->images
                ->map(fn ($img) => asset('storage/' . $img->image_path))
                ->toArray()
            : [asset('images/placeholder-product.jpg')];

        $ongkir = 25000;
        $total  = $barang->harga + $ongkir;

        return view('profile.buyer.checkout', [
            'barang' => $barang,
            'images' => $images,
            'ongkir' => $ongkir,
            'total'  => $total,
        ]);
    }

    // buat order + escrow
public function store(Request $request, Barang $barang)
{
    $order = DB::transaction(function () use ($request, $barang) {

        $total = $barang->harga + 25000;

        $order = Order::create([
            'buyer_id'      => Auth::id(),
            'seller_id'     => $barang->penjual->id,
            'barang_id'     => $barang->id,
            'qty'           => 1,
            'total_price'   => $total,
            'status'        => 'pending',
            'receiver_name' => $request->receiver_name,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'note'          => $request->note,
        ]);

        Escrow::create([
            'order_id' => $order->id,
            'amount'   => $order->total_price,
            'status'   => 'holding',
        ]);

        return $order; // ✅ PENTING
    });

    return redirect()
        ->route('buyer.orders.pay', $order->id)
        ->with('success', 'Pesanan berhasil dibuat, silakan lakukan pembayaran.');
}


}

