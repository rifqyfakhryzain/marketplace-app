@extends('layouts.app')

@section('content')
@php
    /**
     * BUYER ORDER DETAIL – FINAL VERSION
     * Backend nanti cukup kirim $order
     */
    if (!isset($order)) {
        $order = (object) [
            'order_code' => 'ORD-001',
            'status' => 'unpaid', // unpaid | processed | shipped | completed
            'status_label' => 'Menunggu Pembayaran',
            'payment_method' => 'Transfer',
            'total_amount' => 4500000,
            'created_at' => '25 Jan 2026',

            // INFO PENGIRIMAN (WAJIB ADA)
            'shipping' => (object) [
                'name' => 'Hennessy',
                'phone' => '081234567890',
                'address' => 'Jakarta Selatan',
            ],

            'items' => [
                (object) [
                    'product_name' => 'iPhone 11',
                    'qty' => 1,
                    'price' => 4500000,
                    'subtotal' => 4500000,
                ],
            ],

            // khusus status shipped
            'shipment' => (object) [
                'courier' => 'JNE',
                'tracking_number' => 'JNE123456789',
                'last_location' => 'Sorting Center Jakarta',
            ],
        ];
    }
@endphp

<div class="max-w-3xl mx-auto p-6 bg-white rounded">

    <h1 class="text-xl font-semibold mb-6 text-center">
        Detail Pesanan
    </h1>

    {{-- INFO PESANAN --}}
    <div class="text-sm mb-4 space-y-1">
        <p>Kode Pesanan: <b>{{ $order->order_code }}</b></p>
        <p>Tanggal: {{ $order->created_at }}</p>
        <p>Status: <b>{{ $order->status_label }}</b></p>
        <p>Metode Pembayaran: {{ $order->payment_method }}</p>
    </div>

    <hr class="my-4">

    {{-- INFO PENGIRIMAN --}}
    <h2 class="font-semibold mb-2">Informasi Pengiriman</h2>
    <div class="text-sm space-y-1 mb-4">
        <p>Nama: {{ $order->shipping->name }}</p>
        <p>No HP: {{ $order->shipping->phone }}</p>
        <p>Alamat: {{ $order->shipping->address }}</p>
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

    <div class="flex justify-between font-semibold text-sm mb-6">
        <span>Total</span>
        <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
    </div>

    <hr class="my-4">

    {{-- ===== STATUS-BASED ACTION ===== --}}

    {{-- UNPAID --}}
    @if ($order->status === 'unpaid')
        <div class="text-center">
            <p class="text-sm text-gray-600 mb-3">
                Pesanan belum dibayar.
            </p>
            <a href="{{ route('buyer.orders.pay', $id) }}"
            class="bg-blue-600 text-white px-6 py-2 rounded text-sm inline-block">
                Bayar Sekarang
            </a>
        </div>

    {{-- PROCESSED --}}
    @elseif ($order->status === 'processed')
        <div class="text-center text-sm text-blue-600">
            Pesanan sedang diproses oleh penjual.
        </div>

    {{-- SHIPPED --}}
    @elseif ($order->status === 'shipped')
        <div class="text-sm">
            <p class="font-semibold mb-1">Status Pengiriman</p>
            <p>Kurir: {{ $order->shipment->courier }}</p>
            <p>No Resi: {{ $order->shipment->tracking_number }}</p>
            <p>Lokasi Terakhir: {{ $order->shipment->last_location }}</p>
        </div>

    {{-- COMPLETED --}}
    @elseif ($order->status === 'completed')
        <div class="text-center">
            <p class="text-green-600 font-semibold mb-3">
                Pesanan selesai.
            </p>
            <button class="bg-yellow-400 px-6 py-2 rounded text-sm font-semibold">
                Beri Rating
            </button>
        </div>
    @endif

    <div class="text-center mt-8">
        <a href="{{ route('buyer.orders') }}"
           class="text-blue-600 underline text-sm">
            Kembali ke Pesanan Saya
        </a>
    </div>

</div>
@endsection
