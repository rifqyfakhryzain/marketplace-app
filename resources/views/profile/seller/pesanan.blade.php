@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- SIDEBAR --}}
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 sticky top-6">

                        <div class="p-4 border-b bg-gray-50 flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold">Menu Penjual</p>
                                <p class="text-xs text-gray-500">Pengelola Toko</p>
                            </div>
                        </div>

                        <nav class="p-2 space-y-1">
                            <a href="{{ route('seller.statistics') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                                {{ request()->routeIs('seller.statistics') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                                Dashboard & Statistik
                            </a>

                            <a href="{{ route('seller.orders') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                                {{ request()->routeIs('seller.orders') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Pesanan
                            </a>

                            <a href="{{ route('seller.products') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                                {{ request()->routeIs('seller.products*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Produk Saya
                            </a>
                        </nav>
                    </div>
                </div>

                {{-- CONTENT --}}
                <div class="lg:col-span-9 space-y-6">

                    <h1 class="text-2xl font-bold">Manajemen Pesanan</h1>

                    {{-- ORDER LIST --}}
                    <div class="space-y-4">

                        @forelse ($orders as $order)
                            @php
                                $statusMap = [
                                    'processed' => [
                                        'text' => 'Pesanan Diproses',
                                        'class' => 'bg-yellow-100 text-yellow-800',
                                    ],
                                    'processing' => [
                                        'text' => 'Sedang Diproses',
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
                                    'cancelled' => [
                                        'text' => 'Dibatalkan',
                                        'class' => 'bg-red-100 text-red-800',
                                    ],
                                ];

                                $status = $statusMap[$order->status] ?? [
                                    'text' => strtoupper($order->status),
                                    'class' => 'bg-gray-100 text-gray-700',
                                ];
                            @endphp


                            <div class="bg-white border rounded-xl shadow-sm overflow-hidden">

                                {{-- HEADER --}}
                                <div class="px-6 py-3 bg-gray-50 border-b flex justify-between items-center">
                                    <div class="text-sm">
                                        <strong>ORD-{{ $order->id }}</strong>
                                        <span class="text-gray-400 mx-2">|</span>
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </div>
                                    <span class="px-3 py-1 text-xs rounded-full font-semibold {{ $status['class'] }}">
                                        {{ $status['text'] }}
                                    </span>

                                </div>

                                {{-- BODY --}}
                                <div class="p-6 grid md:grid-cols-12 gap-6 items-center">

                                    {{-- PRODUK --}}
                                    <div class="md:col-span-6 flex gap-4">
                                        <div class="w-16 h-16 bg-gray-200 rounded overflow-hidden">
                                            @if ($order->barang && $order->barang->images->count())
                                                <img src="{{ asset('storage/' . $order->barang->images->first()->image_path) }}"
                                                    class="w-full h-full object-cover"
                                                    alt="{{ $order->barang->nama_barang }}">
                                            @else
                                                <div
                                                    class="w-full h-full flex items-center justify-center text-xs text-gray-400">
                                                    No Image
                                                </div>
                                            @endif
                                        </div>

                                        <div>
                                            <p class="font-semibold text-gray-900">
                                                {{ $order->barang->nama_barang ?? '-' }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                Qty: x{{ $order->qty }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- PEMBELI --}}
                                    <div class="md:col-span-3 border-l pl-6">
                                        <p class="text-xs text-gray-500 font-bold uppercase mb-1">Pembeli</p>
                                        <p class="text-sm">{{ $order->buyer->name }}</p>
                                    </div>

                                    {{-- TOTAL --}}
                                    <div class="md:col-span-3 border-l pl-6">
                                        <p class="text-xs text-gray-500 font-bold uppercase mb-1">Total</p>
                                        <p class="text-lg font-bold text-indigo-600">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </p>
                                        <span class="text-xs bg-gray-100 px-2 py-0.5 rounded">
                                            Escrow
                                        </span>
                                    </div>
                                </div>

                                {{-- FOOTER --}}
                                <div class="px-6 py-3 bg-gray-50 border-t flex justify-end gap-3">

                                    <a href="{{ route('seller.orders.show', $order->id) }}"
                                        class="px-4 py-2 text-sm border rounded hover:bg-gray-100">
                                        Lihat Detail
                                    </a>

                                    {{-- TERIMA --}}
                                    @if ($order->status === 'processed')
                                        <form method="POST" action="{{ route('seller.orders.accept', $order->id) }}">
                                            @csrf
                                            <button
                                                class="px-4 py-2 bg-indigo-600 text-white rounded text-sm hover:bg-indigo-700">
                                                Terima Pesanan
                                            </button>
                                        </form>

                                        {{-- KIRIM --}}
                                    @elseif ($order->status === 'processing')
                                        <form method="POST" action="{{ route('seller.orders.ship', $order->id) }}">
                                            @csrf
                                            <button
                                                class="px-4 py-2 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                                                Kirim Pesanan
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </div>

                        @empty
                            <div class="text-center py-12 bg-white border rounded">
                                <p class="text-gray-500">Belum ada pesanan</p>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
