@extends('layouts.app')

@section('content')
    @php
        /**
         * FLOW STATUS BACKEND
         * pending → waiting_verification → processed → shipped → completed
         */

        // Mapping status ke step UI (4 step)
        $stepMap = [
            'pending' => 0,
            'waiting_verification' => 0,
            'processed' => 1,
            'shipped' => 2,
            'completed' => 3,
        ];

        $currentStepIndex = $stepMap[$order->status] ?? 0;

        // Badge status
        $statusLabels = [
            'pending' => [
                'text' => 'Menunggu Pembayaran',
                'class' => 'bg-yellow-100 text-yellow-800',
            ],
            'waiting_verification' => [
                'text' => 'Menunggu Verifikasi',
                'class' => 'bg-orange-100 text-orange-800',
            ],
            'processed' => [
                'text' => 'Diproses Penjual',
                'class' => 'bg-blue-100 text-blue-800',
            ],
            'shipped' => [
                'text' => 'Sedang Dikirim',
                'class' => 'bg-purple-100 text-purple-800',
            ],
            'completed' => [
                'text' => 'Selesai',
                'class' => 'bg-green-100 text-green-800',
            ],
        ];

        $currentLabel = $statusLabels[$order->status] ?? [
            'text' => 'Status Tidak Diketahui',
            'class' => 'bg-gray-100 text-gray-800',
        ];
    @endphp

    <div class="max-w-6xl mx-auto px-4 py-8">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('buyer.orders') }}" class="text-sm text-gray-500 hover:text-blue-600">
                ← Kembali
            </a>

            <div class="text-right">
                <p class="text-xs text-gray-500">No. Pesanan</p>
                <h1 class="text-lg font-bold">ORD-{{ $order->id }}</h1>
            </div>
        </div>

        {{-- STEPPER --}}
        <div class="bg-white border rounded-lg p-6 mb-6">
            <div class="relative flex justify-between items-center">
                <div class="absolute left-0 right-0 top-1/2 h-1 bg-gray-200"></div>

                @foreach (['Belum Bayar', 'Diproses', 'Dikirim', 'Selesai'] as $index => $label)
                    @php
                        $isCompleted = $index < $currentStepIndex;
                        $isCurrent = $index === $currentStepIndex;
                    @endphp

                    <div class="relative z-10 flex flex-col items-center bg-white px-2">
                        <div
                            class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold border-2
                        {{ $isCompleted || $isCurrent
                            ? 'bg-blue-600 border-blue-600 text-white'
                            : 'bg-white border-gray-300 text-gray-400' }}">
                            {{ $isCompleted ? '✓' : $index + 1 }}
                        </div>
                        <span class="text-xs mt-2 {{ $isCurrent ? 'text-blue-600 font-semibold' : 'text-gray-500' }}">
                            {{ $label }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- KIRI --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- ALERT STATUS --}}
                @if ($order->status === 'pending')
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 text-sm text-yellow-700">
                        Segera lakukan pembayaran agar pesanan tidak dibatalkan.
                    </div>
                @endif

                @if ($order->status === 'waiting_verification')
                    <div class="bg-orange-50 border-l-4 border-orange-400 p-4 text-sm text-orange-700">
                        Pembayaran Anda sedang diverifikasi oleh sistem.
                    </div>
                @endif

                {{-- DETAIL PRODUK --}}
                <div class="bg-white border rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b flex justify-between items-center bg-gray-50">
                        <h2 class="font-semibold">Detail Produk</h2>
                        <span class="px-3 py-1 text-xs rounded-full {{ $currentLabel['class'] }}">
                            {{ $currentLabel['text'] }}
                        </span>
                    </div>

                    <div class="p-6">
                        <div class="flex gap-4">
                            <img src="{{ $order->barang->images->first()
                                ? asset('storage/' . $order->barang->images->first()->image_path)
                                : 'https://via.placeholder.com/80' }}"
                                class="w-20 h-20 rounded border object-cover">

                            <div class="flex-1">
                                <h3 class="font-semibold">{{ $order->barang->nama_barang }}</h3>
                                <p class="text-sm text-gray-500">
                                    {{ $order->qty }} x
                                    Rp {{ number_format($order->barang->harga, 0, ',', '.') }}
                                </p>
                            </div>

                            <div class="text-right font-semibold">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- INFO PENGIRIMAN --}}
                <div class="bg-white border rounded-lg p-6">
                    <h2 class="font-semibold mb-4">Info Pengiriman</h2>

                    <p class="font-semibold">{{ $order->receiver_name }}</p>
                    <p class="text-sm">{{ $order->phone }}</p>
                    <p class="text-sm text-gray-500 mt-1">{{ $order->address }}</p>
                </div>
            </div>

            {{-- KANAN --}}
            <div class="space-y-6">

                {{-- RINCIAN --}}
                <div class="bg-white border rounded-lg p-6 sticky top-6">
                    <h2 class="font-semibold mb-4">Rincian Pembayaran</h2>

                    <div class="flex justify-between text-sm mb-2">
                        <span>Total Harga</span>
                        <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>

                    <div class="border-t pt-4 flex justify-between font-bold">
                        <span>Total</span>
                        <span class="text-blue-600">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </span>
                    </div>

                    {{-- AKSI --}}
                    <div class="mt-6 space-y-3">

                        @if ($order->status === 'pending')
                            <a href="{{ route('buyer.orders.pay', $order->id) }}"
                                class="block text-center bg-blue-600 text-white py-3 rounded hover:bg-blue-700">
                                Bayar Sekarang
                            </a>
                        @endif

                        @if ($order->status === 'shipped')
                            <form method="POST" action="{{ route('buyer.orders.confirm', $order->id) }}">
                                @csrf
                                <button class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold">
                                    Pesanan Diterima
                                </button>
                            </form>
                        @endif



                        @if ($order->status === 'completed')
                            <a href="{{ route('products.show', $order->barang_id) }}"
                                class="block text-center bg-blue-50 text-blue-600 py-2 rounded border">
                                Beli Lagi
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
