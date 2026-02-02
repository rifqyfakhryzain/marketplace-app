@extends('layouts.app')

@section('content')
@php
    $orders = [
        (object)[
            'id' => 1,
            'code' => 'ORD-001',
            'date' => '25 Jan 2026',
            'product' => 'iPhone XR',
            'qty' => 1,
            'payment_method' => 'COD – Bayar di tempat',
            'shipping' => (object)[
                'name' => 'Hennessy',
                'phone' => '081234567890',
                'address' => 'Jakarta Selatan',
            ],
            'price' => 25000,
            'status' => 'Menunggu Pembayaran',
            'status_color' => 'bg-yellow-100 text-yellow-700',
        ],
    ];
@endphp

<div class="max-w-5xl mx-auto p-6">

    <h1 class="text-2xl font-semibold mb-6">
        Pesanan Masuk
    </h1>

    <div class="space-y-5">

        @forelse ($orders as $order)
        <div class="border rounded-xl p-5 bg-white shadow-sm">

            {{-- HEADER --}}
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs text-gray-500">Kode Pesanan</p>
                    <p class="font-semibold text-lg">{{ $order->code }}</p>
                    <p class="text-xs text-gray-400">{{ $order->date }}</p>
                </div>

                <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $order->status_color }}">
                    {{ $order->status }}
                </span>
            </div>

            {{-- BODY --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">

                {{-- PRODUK --}}
                <div>
                    <p class="text-gray-500 mb-1">Produk</p>
                    <p class="font-medium">{{ $order->product }}</p>
                    <p class="text-gray-400 text-xs">Qty: {{ $order->qty }}</p>
                </div>

                {{-- PEMBELI --}}
                <div>
                    <p class="text-gray-500 mb-1">Pembeli</p>
                    <p class="font-medium">{{ $order->shipping->name }}</p>
                    <p class="text-gray-400 text-xs">{{ $order->shipping->address }}</p>
                    <p class="text-gray-400 text-xs">📞 {{ $order->shipping->phone }}</p>
                </div>

                {{-- PEMBAYARAN --}}
                <div>
                    <p class="text-gray-500 mb-1">Pembayaran</p>
                    <p class="font-medium">{{ $order->payment_method }}</p>
                    <p class="font-semibold mt-1">
                        Rp {{ number_format($order->price * $order->qty, 0, ',', '.') }}
                    </p>
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="flex justify-end mt-5 pt-4 border-t">
                <a href="{{ route('seller.orders.detail', $order->id) }}"
                   class="text-sm font-semibold text-blue-600 hover:underline">
                    Lihat Detail →
                </a>
            </div>

        </div>
        @empty
            <p class="text-center text-gray-500">
                Belum ada pesanan.
            </p>
        @endforelse

    </div>

</div>
@endsection
