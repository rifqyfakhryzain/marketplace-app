@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- ================= SIDEBAR ================= --}}
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-xl shadow-sm border overflow-hidden sticky top-6">
                        <div class="p-4 border-b bg-gray-50">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h2 class="font-bold text-sm">Menu Penjual</h2>
                                    <p class="text-xs text-gray-500">Pengelola Toko</p>
                                </div>
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

                {{-- ================= CONTENT ================= --}}
                <div class="lg:col-span-9 space-y-6">

                    {{-- HEADER --}}
                    <div>
                        <h1 class="text-2xl font-bold">Ringkasan Toko</h1>
                        <p class="text-sm text-gray-500">
                            Statistik penjualan toko kamu
                        </p>
                    </div>

                    {{-- ================= STATISTIK UTAMA ================= --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                        <div class="bg-white p-5 rounded-xl shadow-sm border">
                            <p class="text-xs text-gray-500 uppercase">Total Pendapatan</p>
                            <h3 class="text-2xl font-bold text-green-600 mt-1">
                                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                            </h3>
                        </div>

                        <div class="bg-white p-5 rounded-xl shadow-sm border">
                            <p class="text-xs text-gray-500 uppercase">Total Pesanan</p>
                            <h3 class="text-2xl font-bold mt-1">
                                {{ $totalOrders }}
                            </h3>
                        </div>

                        <div class="bg-white p-5 rounded-xl shadow-sm border">
                            <p class="text-xs text-gray-500 uppercase">Items Sold</p>
                            <h3 class="text-2xl font-bold mt-1">
                                {{ $totalItems }}
                            </h3>
                        </div>

                        <div class="bg-white p-5 rounded-xl shadow-sm border">
                            <p class="text-xs text-gray-500 uppercase">Listing Aktif</p>
                            <h3 class="text-2xl font-bold mt-1">
                                {{ $activeProducts }}
                            </h3>
                        </div>

                    </div>

                    {{-- ================= STATUS PESANAN ================= --}}
                    <div class="space-y-6">

                        {{-- WALLET CARD --}}
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 max-w-md">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase">
                                        Saldo Wallet
                                    </p>
                                    <h3 class="text-2xl font-bold text-green-600 mt-1">
                                        Rp {{ number_format(auth()->user()->wallet->balance ?? 0, 0, ',', '.') }}
                                    </h3>
                                </div>
                                <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600 text-lg">
                                    💰
                                </div>
                            </div>

                            <div class="mt-4">
                                <form action="{{ route('seller.withdraw.store') }}" method="POST">
                                    @csrf

                                    <input type="number" name="amount" placeholder="Masukkan jumlah withdraw"
                                        class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                                        min="1" required>

                                    <button onclick="return confirm('Yakin ajukan withdraw?')"
                                        class="mt-3 w-full bg-indigo-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                                        Ajukan Withdraw
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- STATUS PESANAN --}}
                        <div>
                            <h3 class="text-lg font-bold mb-4">Status Pesanan</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                                <div class="bg-white border-l-4 border-yellow-400 p-4 rounded-xl shadow-sm">
                                    <p class="text-xs uppercase text-gray-500">Pending</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $pending }}</p>
                                </div>

                                <div class="bg-white border-l-4 border-blue-500 p-4 rounded-xl shadow-sm">
                                    <p class="text-xs uppercase text-gray-500">Diproses</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $processed }}</p>
                                </div>

                                <div class="bg-white border-l-4 border-purple-500 p-4 rounded-xl shadow-sm">
                                    <p class="text-xs uppercase text-gray-500">Dikirim</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $shipped }}</p>
                                </div>

                                <div class="bg-white border-l-4 border-green-500 p-4 rounded-xl shadow-sm">
                                    <p class="text-xs uppercase text-gray-500">Selesai</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $completed }}</p>
                                </div>

                            </div>
                        </div>

                    </div>


                    {{-- ================= PRODUK TERLARIS ================= --}}
                    <div class="bg-white rounded-xl shadow-sm border p-6">
                        <h3 class="text-lg font-bold mb-5">Produk Terlaris</h3>

                        @forelse($topProducts as $index => $product)
                            <div class="flex justify-between items-center py-3 border-b last:border-none">
                                <div class="flex items-center gap-3">
                                    <span
                                        class="w-6 h-6 flex items-center justify-center bg-indigo-100 text-indigo-600 text-xs font-bold rounded">
                                        {{ $index + 1 }}
                                    </span>
                                    <span class="font-medium">
                                        {{ $product->nama_barang }}
                                    </span>
                                </div>

                                <div class="text-sm font-bold text-gray-700">
                                    {{ $product->total_sold }} Terjual
                                </div>
                            </div>
                        @empty
                            <div class="text-gray-500 text-sm">
                                Belum ada produk terjual
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
