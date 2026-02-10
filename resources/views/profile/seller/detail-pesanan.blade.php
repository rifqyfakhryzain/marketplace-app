@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">

        {{-- HEADER --}}
        <div class="mb-6 text-center">
            <h1 class="text-xl font-bold">Detail Pesanan</h1>
            <p class="text-sm text-gray-500">
                ORD-{{ $order->id }} • {{ $order->created_at->format('d M Y, H:i') }}
            </p>
        </div>

        {{-- INFO STATUS --}}
        <div class="bg-white rounded-xl border shadow-sm p-6 mb-6 text-sm">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-500">Status Pesanan</p>
                    <span
                        class="inline-block mt-1 px-3 py-1 rounded-full text-xs font-semibold
                    @if ($order->status === 'processed') bg-yellow-100 text-yellow-800
                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                    @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                    @elseif($order->status === 'completed') bg-green-100 text-green-800
                    @else bg-gray-100 text-gray-700 @endif">
                        {{ strtoupper($order->status) }}
                    </span>
                </div>

                <div>
                    <p class="text-gray-500">Status Escrow</p>
                    <span class="inline-block mt-1 px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                        {{ strtoupper($order->escrow?->status ?? 'N/A') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- INFO PEMBELI --}}
        <div class="bg-white rounded-xl border shadow-sm p-6 mb-6">
            <h2 class="font-semibold mb-3">Informasi Pembeli</h2>
            <div class="text-sm space-y-1">
                <p><b>Nama:</b> {{ $order->buyer->name }}</p>
                <p><b>Email:</b> {{ $order->buyer->email }}</p>
                <p><b>No HP:</b> {{ $order->phone }}</p>
                <p><b>Alamat:</b> {{ $order->address }}</p>
            </div>
        </div>

        {{-- PRODUK --}}
        <div class="bg-white rounded-xl border shadow-sm p-6 mb-6">
            <h2 class="font-semibold mb-4">Produk Dipesan</h2>

            <div class="flex gap-4 items-center">
                <div class="w-20 h-20 bg-gray-100 rounded overflow-hidden">
                    @if ($order->barang && $order->barang->images->count())
                        <img src="{{ asset('storage/' . $order->barang->images->first()->image_path) }}"
                            class="w-full h-full object-cover" alt="{{ $order->barang->nama_barang }}">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-xs text-gray-400">
                            No Image
                        </div>
                    @endif
                </div>

                <div class="flex-1">
                    <p class="font-semibold">{{ $order->barang->nama_barang }}</p>
                    <p class="text-sm text-gray-500">Qty: x{{ $order->qty }}</p>
                </div>

                <div class="text-right">
                    <p class="text-sm text-gray-500">Harga</p>
                    <p class="font-semibold">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- TOTAL --}}
        <div class="bg-white rounded-xl border shadow-sm p-6 mb-6">
            <div class="flex justify-between font-semibold">
                <span>Total Pesanan</span>
                <span class="text-indigo-600">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </span>
            </div>
        </div>

        {{-- AKSI SELLER --}}
        <div class="flex justify-between items-center">
            <a href="{{ route('seller.orders') }}" class="px-4 py-2 border rounded text-sm hover:bg-gray-100">
                ← Kembali
            </a>

            {{-- TERIMA PESANAN --}}
            @if ($order->status === 'processed')
                <form method="POST" action="{{ route('seller.orders.accept', $order->id) }}">
                    @csrf
                    <button class="px-6 py-2 bg-indigo-600 text-white rounded text-sm hover:bg-indigo-700">
                        Terima Pesanan
                    </button>
                </form>

                {{-- KIRIM PESANAN --}}
            @elseif ($order->status === 'processing')
                <form method="POST" action="{{ route('seller.orders.ship', $order->id) }}">
                    @csrf
                    <button class="px-6 py-2 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                        Kirim Pesanan
                    </button>
                </form>
            @endif
        </div>

    </div>
@endsection
