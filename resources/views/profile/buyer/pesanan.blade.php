@extends('layouts.app')

@section('content')
@php
    // status aktif dari URL (?status=...)
    $activeStatus = request('status');

    // DUMMY DATA PESANAN
    $orders = [
        (object) [
            'id' => 1,
            'code' => 'ORD-001',
            'product' => 'iPhone 11',
            'total' => 4500000,
            'status' => 'unpaid',
            'status_label' => 'Menunggu Pembayaran',
            'status_color' => 'text-yellow-600',
        ],
        (object) [
            'id' => 2,
            'code' => 'ORD-002',
            'product' => 'Laptop ASUS',
            'total' => 7200000,
            'status' => 'processed',
            'status_label' => 'Diproses',
            'status_color' => 'text-blue-600',
        ],
        (object) [
            'id' => 3,
            'code' => 'ORD-003',
            'product' => 'Headset Gaming',
            'total' => 850000,
            'status' => 'shipped',
            'status_label' => 'Dikirim',
            'status_color' => 'text-purple-600',
        ],
        (object) [
            'id' => 4,
            'code' => 'ORD-004',
            'product' => '+2 Produk',
            'total' => 1850000,
            'status' => 'completed',
            'status_label' => 'Selesai',
            'status_color' => 'text-green-600',
        ],
    ];

    // FILTERING
    if ($activeStatus) {
        $orders = array_values(array_filter($orders, function ($order) use ($activeStatus) {
            return $order->status === $activeStatus;
        }));
    }
@endphp

<div class="max-w-4xl mx-auto p-6 bg-white rounded">

    <h1 class="text-xl font-semibold mb-6 text-center">
        Pesanan Saya
    </h1>

    {{-- FILTER --}}
    <div class="flex justify-center gap-6 text-sm mb-6">
        <a href="{{ route('buyer.orders') }}"
           class="{{ !$activeStatus ? 'font-semibold text-black' : 'text-gray-500' }}">
            Semua
        </a>

        <a href="{{ route('buyer.orders', ['status' => 'unpaid']) }}"
           class="{{ $activeStatus === 'unpaid' ? 'font-semibold text-black' : 'text-gray-500' }}">
            Belum Dibayar
        </a>

        <a href="{{ route('buyer.orders', ['status' => 'processed']) }}"
           class="{{ $activeStatus === 'processed' ? 'font-semibold text-black' : 'text-gray-500' }}">
            Diproses
        </a>

        <a href="{{ route('buyer.orders', ['status' => 'shipped']) }}"
           class="{{ $activeStatus === 'shipped' ? 'font-semibold text-black' : 'text-gray-500' }}">
            Dikirim
        </a>

        <a href="{{ route('buyer.orders', ['status' => 'completed']) }}"
           class="{{ $activeStatus === 'completed' ? 'font-semibold text-black' : 'text-gray-500' }}">
            Selesai
        </a>
    </div>

    {{-- LIST PESANAN --}}
    <div class="space-y-4">

        @forelse ($orders as $order)
            <div class="border rounded p-4">
                <div class="flex justify-between text-sm mb-2">
                    <p>Kode: <b>{{ $order->code }}</b></p>
                    <p class="font-medium {{ $order->status_color }}">
                        {{ $order->status_label }}
                    </p>
                </div>

                <p class="text-sm mb-1">
                    {{ $order->product }}
                </p>

                <p class="text-sm text-gray-500 mb-2">
                    Total: Rp {{ number_format($order->total, 0, ',', '.') }}
                </p>

                <a href="{{ route('buyer.orders.detail', $order->id) }}"
                   class="text-blue-600 text-sm underline">
                    Lihat Detail
                </a>
            </div>
        @empty
            <p class="text-center text-gray-500">
                Tidak ada pesanan untuk status ini.
            </p>
        @endforelse

    </div>

</div>
@endsection
