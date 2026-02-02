@extends('layouts.app')

@section('content')
@php
    /**
     * SAFETY NET – SELLER ORDER DETAIL
     * Backend nanti tinggal kirim $order
     */
    if (!isset($order)) {
        $order = (object) [
            'order_code' => 'ORD-001',
            'status' => 'Menunggu Pembayaran',
            'payment_method' => 'Transfer',
            'total_amount' => 4500000,
            'created_at' => '25 Jan 2026',

            'buyer' => (object) [
                'name' => 'Hennessy',
                'phone' => '081234567890',
                'address' => 'Jakarta Selatan',
                'email' => 'hennessy@mail.com',
            ],

            'items' => [
                (object) [
                    'product_name' => 'iPhone 11',
                    'qty' => 1,
                    'price' => 4500000,
                    'subtotal' => 4500000,
                ],
            ],

            'shipment' => null,

            'histories' => [
                (object) [
                    'created_at' => '25 Jan 2026 10:00',
                    'status' => 'Menunggu Pembayaran',
                    'note' => 'Pesanan dibuat'
                ],
            ],
        ];
    }
@endphp

<div class="max-w-4xl mx-auto p-6 bg-white rounded">

    <h1 class="text-xl font-semibold mb-6 text-center">
        Detail Pesanan (Penjual)
    </h1>

    {{-- INFO PESANAN --}}
    <div class="text-sm mb-4">
        <p>Kode Pesanan: <b>{{ $order->order_code }}</b></p>
        <p>Tanggal: {{ $order->created_at }}</p>
        <p>Status: <b>{{ $order->status }}</b></p>
        <p>Metode Pembayaran: {{ $order->payment_method }}</p>
    </div>

    <hr class="my-4">

    {{-- INFO PEMBELI --}}
    <h2 class="font-semibold mb-2">Informasi Pembeli</h2>
    <div class="text-sm space-y-1 mb-4">
        <p>Nama: {{ $order->buyer->name }}</p>
        <p>Email: {{ $order->buyer->email }}</p>
        <p>No HP: {{ $order->buyer->phone }}</p>
        <p>Alamat: {{ $order->buyer->address }}</p>
    </div>

    <hr class="my-4">

    {{-- PRODUK --}}
    <h2 class="font-semibold mb-2">Produk</h2>
    <table class="w-full text-sm mb-4 border">
        <thead class="bg-gray-50">
            <tr>
                <th class="text-left p-2">Produk</th>
                <th class="text-center p-2">Qty</th>
                <th class="text-right p-2">Harga</th>
                <th class="text-right p-2">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
            <tr class="border-t">
                <td class="p-2">{{ $item->product_name }}</td>
                <td class="p-2 text-center">{{ $item->qty }}</td>
                <td class="p-2 text-right">
                    Rp {{ number_format($item->price, 0, ',', '.') }}
                </td>
                <td class="p-2 text-right">
                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TOTAL --}}
    <div class="flex justify-between font-semibold text-sm mb-4">
        <span>Total Pesanan</span>
        <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
    </div>

    <hr class="my-4">

    {{-- PENGIRIMAN --}}
    <h2 class="font-semibold mb-2">Pengiriman</h2>
    @if ($order->shipment)
        <p>Kurir: {{ $order->shipment->courier }}</p>
        <p>Resi: {{ $order->shipment->tracking_number }}</p>
    @else
        <p class="text-sm text-gray-500">Belum dikirim</p>
    @endif

    <hr class="my-4">

    {{-- RIWAYAT --}}
    <h2 class="font-semibold mb-2">Riwayat Status</h2>
    <ul class="text-sm list-disc pl-5">
        @foreach ($order->histories as $history)
            <li>
                {{ $history->created_at }} —
                <b>{{ $history->status }}</b> —
                {{ $history->note }}
            </li>
        @endforeach
    </ul>

    <hr class="my-6">

    {{-- AKSI --}}
    <div class="flex justify-center gap-3">
        <button class="bg-blue-600 text-white px-6 py-2 rounded text-sm">
            Proses Pesanan
        </button>

        <a href="{{ route('seller.orders') }}"
           class="px-6 py-2 rounded text-sm border">
            Kembali
        </a>
    </div>

</div>
@endsection
