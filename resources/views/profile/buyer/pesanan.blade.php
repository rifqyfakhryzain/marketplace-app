@extends('layouts.app')

@section('content')
@php
    // status aktif dari URL
    $activeStatus = request('status');

    // DUMMY DATA YANG DIPERBARUI (Lebih lengkap)
    $orders = [
        (object) [
            'id' => 1,
            'code' => 'ORD-20231025-001',
            'date' => '25 Okt 2023',
            'product_name' => 'iPhone 11 128GB - Black',
            'product_image' => 'https://via.placeholder.com/80?text=HP', // Placeholder
            'qty' => 1,
            'other_items_count' => 0,
            'total' => 4500000,
            'status' => 'unpaid',
            'status_label' => 'Menunggu Pembayaran',
            'status_class' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
        ],
        (object) [
            'id' => 2,
            'code' => 'ORD-20231024-009',
            'date' => '24 Okt 2023',
            'product_name' => 'Laptop ASUS Vivobook',
            'product_image' => 'https://via.placeholder.com/80?text=Lap',
            'qty' => 1,
            'other_items_count' => 1, // Contoh ada item lain
            'total' => 7200000,
            'status' => 'processed',
            'status_label' => 'Diproses Penjual',
            'status_class' => 'bg-blue-100 text-blue-800 border-blue-200',
        ],
        (object) [
            'id' => 3,
            'code' => 'ORD-20231020-055',
            'date' => '20 Okt 2023',
            'product_name' => 'Logitech G Pro Headset',
            'product_image' => 'https://via.placeholder.com/80?text=Head',
            'qty' => 1,
            'other_items_count' => 0,
            'total' => 850000,
            'status' => 'shipped',
            'status_label' => 'Sedang Dikirim',
            'status_class' => 'bg-purple-100 text-purple-800 border-purple-200',
            'resi' => 'JP1234567890'
        ],
        (object) [
            'id' => 4,
            'code' => 'ORD-20231001-112',
            'date' => '01 Okt 2023',
            'product_name' => 'Kabel Data Type-C',
            'product_image' => 'https://via.placeholder.com/80?text=Acc',
            'qty' => 2,
            'other_items_count' => 2,
            'total' => 185000,
            'status' => 'completed',
            'status_label' => 'Selesai',
            'status_class' => 'bg-green-100 text-green-800 border-green-200',
        ],
    ];

    // FILTERING
    if ($activeStatus) {
        $orders = array_values(array_filter($orders, function ($order) use ($activeStatus) {
            return $order->status === $activeStatus;
        }));
    }

    // Helper untuk class nav active
    function getNavClass($isActive) {
        return $isActive
            ? 'border-blue-600 text-blue-600 font-semibold'
            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300';
    }
@endphp

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Transaksi</h1>
        
        {{-- Search Bar Sederhana (Opsional) --}}
        <div class="mt-4 sm:mt-0 relative">
            <input type="text" placeholder="Cari nomor pesanan..." class="pl-10 pr-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full sm:w-64">
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
    </div>

    {{-- NAVIGASI STATUS (Scrollable di Mobile) --}}
    <div class="border-b border-gray-200 mb-6 overflow-x-auto">
        <nav class="-mb-px flex space-x-8 min-w-max" aria-label="Tabs">
            <a href="{{ route('buyer.orders') }}"
               class="whitespace-nowrap py-4 px-1 border-b-2 text-sm font-medium {{ getNavClass(!$activeStatus) }}">
                Semua Pesanan
            </a>
            <a href="{{ route('buyer.orders', ['status' => 'unpaid']) }}"
               class="whitespace-nowrap py-4 px-1 border-b-2 text-sm font-medium {{ getNavClass($activeStatus === 'unpaid') }}">
                Belum Bayar
            </a>
            <a href="{{ route('buyer.orders', ['status' => 'processed']) }}"
               class="whitespace-nowrap py-4 px-1 border-b-2 text-sm font-medium {{ getNavClass($activeStatus === 'processed') }}">
                Diproses
            </a>
            <a href="{{ route('buyer.orders', ['status' => 'shipped']) }}"
               class="whitespace-nowrap py-4 px-1 border-b-2 text-sm font-medium {{ getNavClass($activeStatus === 'shipped') }}">
                Dikirim
            </a>
            <a href="{{ route('buyer.orders', ['status' => 'completed']) }}"
               class="whitespace-nowrap py-4 px-1 border-b-2 text-sm font-medium {{ getNavClass($activeStatus === 'completed') }}">
                Selesai
            </a>
        </nav>
    </div>

    {{-- LIST PESANAN --}}
    <div class="space-y-6">
        @forelse ($orders as $order)
            <div class="bg-white border rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
                
                {{-- Card Header: Tanggal & Status --}}
                <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row justify-between items-start sm:items-center border-b gap-2">
                    <div class="flex items-center gap-4 text-sm text-gray-600">
                        <span>{{ $order->date }}</span>
                        <span class="text-gray-300">|</span>
                        <span>{{ $order->code }}</span>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $order->status_class }}">
                        {{ $order->status_label }}
                    </span>
                </div>

                {{-- Card Body: Info Produk --}}
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row gap-4">
                        {{-- Gambar Produk --}}
                        <div class="flex-shrink-0">
                            <img src="{{ $order->product_image }}" alt="{{ $order->product_name }}" class="w-20 h-20 object-cover rounded-md border bg-gray-100">
                        </div>
                        
                        {{-- Detail Produk --}}
                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-900 line-clamp-1">
                                {{ $order->product_name }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $order->qty }} Barang 
                                @if($order->other_items_count > 0)
                                    <span class="text-gray-400 text-xs">+ {{ $order->other_items_count }} produk lainnya</span>
                                @endif
                            </p>
                        </div>

                        {{-- Total Harga & Label Status kecil --}}
                        <div class="text-left sm:text-right mt-2 sm:mt-0">
                            <p class="text-xs text-gray-500">Total Belanja</p>
                            <p class="text-lg font-bold text-gray-900">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Card Footer: Action Buttons (Dinamis berdasarkan status) --}}
                <div class="px-6 py-4 bg-white border-t flex flex-col sm:flex-row justify-end gap-3">
                    <a href="{{ route('buyer.orders.detail', $order->id) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 text-center">
                        Lihat Detail
                    </a>

                    @if ($order->status === 'unpaid')
                        <button class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 text-center shadow-sm">
                            Bayar Sekarang
                        </button>
                    @elseif ($order->status === 'shipped')
                        <button class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-md hover:bg-purple-700 text-center shadow-sm">
                            Lacak Paket
                        </button>
                    @elseif ($order->status === 'completed')
                        <button class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-md hover:bg-blue-100 text-center">
                            Beli Lagi
                        </button>
                    @endif
                </div>
            </div>
        @empty
            {{-- Empty State yang lebih menarik --}}
            <div class="text-center py-16 bg-white rounded-lg border border-dashed border-gray-300">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada pesanan</h3>
                <p class="mt-1 text-sm text-gray-500">
                    @if($activeStatus)
                        Tidak ada pesanan dengan status "{{ ucfirst($activeStatus) }}".
                    @else
                        Mulailah berbelanja untuk melihat pesanan Anda di sini.
                    @endif
                </p>
                <div class="mt-6">
                    <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Mulai Belanja
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection