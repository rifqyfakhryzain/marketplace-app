@extends('layouts.app')

@section('content')
@php
    /**
     * ESCROW PAYMENT PAGE (BUYER)
     * Backend nanti tinggal kirim $order & $escrow
     */
    if (!isset($order)) {
        $order = (object) [
            'order_code' => 'ORD-001',
            'created_at' => '25 Jan 2026',
            'total_amount' => 4500000,
            'status' => 'unpaid',

            'items' => [
                (object) [
                    'product_name' => 'iPhone 11',
                    'qty' => 1,
                ],
            ],
        ];
    }

    if (!isset($escrow)) {
        $escrow = (object) [
            'bank' => 'BCA',
            'account_number' => '1234567890',
            'account_name' => 'PT LUNO INDONESIA',
            'expired_at' => '26 Jan 2026 23:59',
        ];
    }
@endphp

<div class="max-w-3xl mx-auto p-6 bg-white rounded">

    <h1 class="text-xl font-semibold mb-2 text-center">
        Pembayaran Aman (Escrow)
    </h1>

    <p class="text-sm text-gray-600 text-center mb-6">
        Dana Anda akan ditahan oleh <b>LUNO</b> sampai barang diterima.
    </p>

    {{-- RINGKASAN PESANAN --}}
    <div class="border rounded p-4 mb-6">
        <h2 class="font-semibold mb-2">Ringkasan Pesanan</h2>

        <div class="text-sm space-y-1">
            <p>Kode Pesanan: <b>{{ $order->order_code }}</b></p>
            <p>Tanggal Pesanan: {{ $order->created_at }}</p>

            <p class="mt-2 font-medium">Produk:</p>
            @foreach ($order->items as $item)
                <p>- {{ $item->product_name }} (Qty: {{ $item->qty }})</p>
            @endforeach
        </div>
    </div>

    {{-- TOTAL --}}
    <div class="flex justify-between items-center mb-6">
        <span class="text-sm font-semibold">Total Pembayaran</span>
        <span class="text-lg font-bold text-blue-600">
            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
        </span>
    </div>

    {{-- INFO ESCROW --}}
    <div class="border rounded p-4 mb-6 bg-gray-50">
        <h2 class="font-semibold mb-2">Transfer ke Rekening Bersama</h2>

        <div class="text-sm space-y-1">
            <p>Bank: <b>{{ $escrow->bank }}</b></p>
            <p>No Rekening: <b>{{ $escrow->account_number }}</b></p>
            <p>Atas Nama: <b>{{ $escrow->account_name }}</b></p>
        </div>

        <p class="text-xs text-gray-600 mt-3">
            ⚠️ Pastikan nominal transfer <b>sesuai</b>.  
            Dana akan ditahan oleh LUNO dan <b>baru diteruskan ke penjual</b>
            setelah Anda mengonfirmasi barang diterima.
        </p>
    </div>

    {{-- BATAS WAKTU --}}
    <div class="text-sm text-red-600 mb-6">
        Batas waktu pembayaran: <b>{{ $escrow->expired_at }}</b>
    </div>

    {{-- AKSI --}}
    <div class="flex flex-col items-center gap-3">

        {{-- dummy action --}}
        <button class="bg-blue-600 text-white px-6 py-2 rounded text-sm w-full max-w-xs">
            Saya Sudah Transfer
        </button>

        <a href="{{ route('buyer.orders.detail', 1) }}"
           class="text-sm text-blue-600 underline">
            Kembali ke Detail Pesanan
        </a>
    </div>

</div>
@endsection
