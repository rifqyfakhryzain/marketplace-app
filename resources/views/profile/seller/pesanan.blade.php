@extends('layouts.app')

@section('content')
@php
    // SIMULATED DATA (In real app, this comes from Controller)
    $orders = [
        (object)[
            'id' => 1,
            'code' => 'ORD-2024-001',
            'created_at' => \Carbon\Carbon::now()->subHours(2),
            'product_name' => 'iPhone XR 64GB - Red Edition',
            'product_img' => null, // Placeholder logic used below
            'qty' => 1,
            'customer_name' => 'Budi Santoso',
            'customer_city' => 'Jakarta Selatan',
            'total_price' => 4500000,
            'payment_method' => 'COD',
            'status' => 'pending', // pending, processing, shipped, completed, cancelled
        ],
        (object)[
            'id' => 2,
            'code' => 'ORD-2024-002',
            'created_at' => \Carbon\Carbon::now()->subDays(1),
            'product_name' => 'Laptop ASUS Vivobook',
            'product_img' => null,
            'qty' => 1,
            'customer_name' => 'Siti Aminah',
            'customer_city' => 'Bandung',
            'total_price' => 8200000,
            'payment_method' => 'Transfer Bank',
            'status' => 'processing',
        ],
        (object)[
            'id' => 3,
            'code' => 'ORD-2024-003',
            'created_at' => \Carbon\Carbon::now()->subDays(3),
            'product_name' => 'Mouse Logitech Silent',
            'product_img' => null,
            'qty' => 2,
            'customer_name' => 'Ahmad Dani',
            'customer_city' => 'Surabaya',
            'total_price' => 300000,
            'payment_method' => 'E-Wallet',
            'status' => 'shipped',
        ]
    ];
@endphp

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            {{-- LEFT SIDEBAR: NAVIGATION --}}
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden sticky top-6">
                        {{-- User Short Profile --}}
                        <div class="p-4 border-b border-gray-100 bg-gray-50">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h2 class="font-bold text-gray-900 text-sm">Menu Penjual</h2>
                                    <p class="text-xs text-gray-500">Pengelola Toko</p>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Menu Links --}}
                        <nav class="p-2 space-y-1">
                            <a href="{{ route('seller.statistics') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                                {{ request()->routeIs('seller.statistics') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                Dashboard & Statistik
                            </a>

                            <a href="{{ route('seller.orders') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                                {{ request()->routeIs('seller.orders') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                Pesanan
                            </a>

                            <a href="{{ route('seller.products') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                                {{ request()->routeIs('seller.products*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                Produk Saya
                            </a>
                        </nav>
                    </div>
                </div>

            {{-- MAIN CONTENT --}}
            <div class="lg:col-span-9 space-y-6">

                {{-- HEADER & SEARCH --}}
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h1 class="text-2xl font-bold text-gray-900">Manajemen Pesanan</h1>
                    
                    <div class="relative w-full sm:w-64">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
                        <input type="text" placeholder="Search Order ID or Customer..." 
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                    </div>
                </div>

                {{-- STATUS TABS --}}
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-6 overflow-x-auto">
                        <a href="#" class="border-indigo-500 text-indigo-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Semua Pesanan
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center gap-2">
                            Pending <span class="bg-yellow-100 text-yellow-800 py-0.5 px-1.5 rounded-full text-xs">1</span>
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Siap Dikirim
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Selesai
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Batal
                        </a>
                    </nav>
                </div>

                {{-- ORDER LIST --}}
                <div class="space-y-4">
                    @forelse ($orders as $order)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-200">
                            
                            {{-- CARD HEADER --}}
                            <div class="bg-gray-50 px-6 py-3 border-b border-gray-100 flex flex-wrap justify-between items-center gap-2">
                                <div class="flex items-center gap-4 text-sm">
                                    <span class="font-bold text-gray-900">{{ $order->code }}</span>
                                    <span class="text-gray-400">|</span>
                                    <span class="text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                
                                {{-- Status Badge Logic --}}
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'shipped' => 'bg-purple-100 text-purple-800 border-purple-200',
                                        'completed' => 'bg-green-100 text-green-800 border-green-200',
                                        'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                                    ];
                                    $statusClass = $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide border {{ $statusClass }}">
                                    {{ $order->status }}
                                </span>
                            </div>

                            {{-- CARD BODY --}}
                            <div class="p-6 grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                                
                                {{-- Product Info --}}
                                <div class="md:col-span-6 flex gap-4">
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex-shrink-0 overflow-hidden">
                                        @if($order->product_img)
                                            <img src="{{ $order->product_img }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No Img</div>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900 text-sm line-clamp-2">{{ $order->product_name }}</h3>
                                        <p class="text-xs text-gray-500 mt-1">Quantity: x{{ $order->qty }}</p>
                                        @if($order->qty > 1)
                                            <p class="text-xs text-indigo-600 mt-0.5 cursor-pointer hover:underline">+ {{ $order->qty - 1 }} other items</p>
                                        @endif
                                    </div>
                                </div>

                                {{-- Customer Info --}}
                                <div class="md:col-span-3 border-l border-gray-100 md:pl-6">
                                    <p class="text-xs text-gray-500 uppercase font-bold mb-1">Pelanggan</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</p>
                                    <p class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                                        📍 {{ $order->customer_city }}
                                    </p>
                                </div>

                                {{-- Payment Info --}}
                                <div class="md:col-span-3 border-l border-gray-100 md:pl-6">
                                    <p class="text-xs text-gray-500 uppercase font-bold mb-1">Total Pembayaran</p>
                                    <p class="text-lg font-bold text-indigo-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    <div class="flex items-center gap-1 mt-1">
                                        <span class="text-xs px-2 py-0.5 rounded bg-gray-100 text-gray-600 font-medium">
                                            {{ $order->payment_method }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- CARD FOOTER (Quick Actions) --}}
                            <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-end gap-3">
                                
                                <a href="{{ route('seller.orders.detail', $order->id) }}" 
                                   class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 transition shadow-sm">
                                    Lihat Detail
                                </a>

                                @if($order->status == 'pending')
                                    <button class="px-4 py-2 rounded-lg text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition shadow-sm flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Terima Pesanan
                                    </button>
                                @elseif($order->status == 'processing')
                                    <button class="px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition shadow-sm flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                        Kirim Pesanan
                                    </button>
                                @endif

                            </div>
                        </div>
                    @empty
                        {{-- EMPTY STATE --}}
                        <div class="text-center py-12 bg-white rounded-xl shadow-sm border border-gray-100">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                                📦
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">Tidak Ada Pesanan</h3>
                            <p class="text-gray-500">Tidak ada pesanan yang sesuai dengan kriteria Anda saat ini.</p>
                        </div>
                    @endforelse
                </div>

                {{-- PAGINATION --}}
                <div class="mt-6">
                    {{-- {{ $orders->links() }} --}}
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection