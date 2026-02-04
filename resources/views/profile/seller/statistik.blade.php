@extends('layouts.app')

@section('content')
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

                {{-- RIGHT CONTENT --}}
                <div class="lg:col-span-9 space-y-6">

                    {{-- HEADER & DATE FILTER --}}
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Ringkasan Toko</h1>
                            <p class="text-sm text-gray-500">Here's what's happening with your store today.</p>
                        </div>
                        
                        {{-- Date Filter (UI Only) --}}
                        <div class="flex items-center gap-2 bg-white border border-gray-300 rounded-lg p-1.5 shadow-sm">
                            <button class="px-3 py-1.5 text-xs font-medium bg-gray-100 rounded text-gray-700">30 Hari Terakhir</button>
                            <button class="px-3 py-1.5 text-xs font-medium text-gray-500 hover:bg-gray-50 rounded">Bulan Ini</button>
                            <button class="px-3 py-1.5 text-xs font-medium text-gray-500 hover:bg-gray-50 rounded">Semua</button>
                        </div>
                    </div>

                    {{-- 1. KEY METRICS CARDS --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        
                        {{-- Card: Revenue --}}
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase">Total Pendapatan</p>
                                    <h3 class="text-2xl font-bold text-gray-900 mt-1">Rp 12.4Jt</h3>
                                </div>
                                <div class="p-2 bg-green-50 rounded-lg text-green-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-xs">
                                <span class="text-green-600 font-medium flex items-center">
                                    ↑ 12% 
                                </span>
                                <span class="text-gray-400 ml-2">vs bulan lalu</span>
                            </div>
                        </div>

                        {{-- Card: Total Orders --}}
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase">Total Pesanan</p>
                                    <h3 class="text-2xl font-bold text-gray-900 mt-1">28</h3>
                                </div>
                                <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-xs">
                                <span class="text-green-600 font-medium">↑ 4 Baru</span>
                                <span class="text-gray-400 ml-2">minggu ini</span>
                            </div>
                        </div>

                        {{-- Card: Products Sold --}}
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase">Items Sold</p>
                                    <h3 class="text-2xl font-bold text-gray-900 mt-1">19</h3>
                                </div>
                                <div class="p-2 bg-purple-50 rounded-lg text-purple-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                            </div>
                             <div class="mt-4 flex items-center text-xs">
                                <span class="text-gray-500">Rata-rata 1.5 item / pesanan</span>
                            </div>
                        </div>

                        {{-- Card: Active Products --}}
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase">Listing Aktif</p>
                                    <h3 class="text-2xl font-bold text-gray-900 mt-1">6</h3>
                                </div>
                                <div class="p-2 bg-orange-50 rounded-lg text-orange-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-xs">
                                <a href="{{ route('seller.products') }}" class="text-indigo-600 hover:underline">Kelola Produk →</a>
                            </div>
                        </div>
                    </div>

                    {{-- 2. ORDER STATUS PIPELINE --}}
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Status Pesanan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            {{-- Pending --}}
                            <div class="bg-white border-l-4 border-yellow-400 p-4 rounded-r-xl shadow-sm flex items-center justify-between cursor-pointer hover:shadow-md transition">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-semibold">Pending</p>
                                    <p class="text-xl font-bold text-gray-900">3</p>
                                </div>
                                <span class="text-yellow-500 bg-yellow-50 p-2 rounded-full">⏳</span>
                            </div>

                            {{-- Processing --}}
                            <div class="bg-white border-l-4 border-blue-500 p-4 rounded-r-xl shadow-sm flex items-center justify-between cursor-pointer hover:shadow-md transition">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-semibold">Diproses</p>
                                    <p class="text-xl font-bold text-gray-900">4</p>
                                </div>
                                <span class="text-blue-500 bg-blue-50 p-2 rounded-full">⚙️</span>
                            </div>

                             {{-- Shipped --}}
                             <div class="bg-white border-l-4 border-purple-500 p-4 rounded-r-xl shadow-sm flex items-center justify-between cursor-pointer hover:shadow-md transition">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-semibold">Dikirim</p>
                                    <p class="text-xl font-bold text-gray-900">2</p>
                                </div>
                                <span class="text-purple-500 bg-purple-50 p-2 rounded-full">🚚</span>
                            </div>

                            {{-- Completed --}}
                            <div class="bg-white border-l-4 border-green-500 p-4 rounded-r-xl shadow-sm flex items-center justify-between cursor-pointer hover:shadow-md transition">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-semibold">Selesai</p>
                                    <p class="text-xl font-bold text-gray-900">19</p>
                                </div>
                                <span class="text-green-500 bg-green-50 p-2 rounded-full">✅</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        
                        {{-- 3. TOP SELLING PRODUCTS --}}
                        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-5">Produk Terlaris</h3>
                            
                            <div class="space-y-6">
                                {{-- Item 1 --}}
                                <div class="relative">
                                    <div class="flex items-center justify-between text-sm mb-1">
                                        <div class="flex items-center gap-2">
                                            <span class="w-5 h-5 flex items-center justify-center bg-yellow-100 text-yellow-700 text-xs font-bold rounded">1</span>
                                            <span class="font-medium text-gray-900">iPhone 11 (64GB)</span>
                                        </div>
                                        <div class="text-right">
                                            <span class="block font-bold text-gray-900">Rp 22.500.000</span>
                                            <span class="text-xs text-gray-500">5 Terjual</span>
                                        </div>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-indigo-600 h-2 rounded-full" style="width: 85%"></div>
                                    </div>
                                </div>

                                {{-- Item 2 --}}
                                <div class="relative">
                                    <div class="flex items-center justify-between text-sm mb-1">
                                        <div class="flex items-center gap-2">
                                            <span class="w-5 h-5 flex items-center justify-center bg-gray-100 text-gray-600 text-xs font-bold rounded">2</span>
                                            <span class="font-medium text-gray-900">Laptop ASUS Vivobook</span>
                                        </div>
                                        <div class="text-right">
                                            <span class="block font-bold text-gray-900">Rp 21.600.000</span>
                                            <span class="text-xs text-gray-500">3 Terjual</span>
                                        </div>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-indigo-400 h-2 rounded-full" style="width: 65%"></div>
                                    </div>
                                </div>

                                {{-- Item 3 --}}
                                <div class="relative">
                                    <div class="flex items-center justify-between text-sm mb-1">
                                        <div class="flex items-center gap-2">
                                            <span class="w-5 h-5 flex items-center justify-center bg-gray-100 text-gray-600 text-xs font-bold rounded">3</span>
                                            <span class="font-medium text-gray-900">Mouse Logitech Wireless</span>
                                        </div>
                                        <div class="text-right">
                                            <span class="block font-bold text-gray-900">Rp 1.500.000</span>
                                            <span class="text-xs text-gray-500">10 Terjual</span>
                                        </div>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-indigo-300 h-2 rounded-full" style="width: 30%"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6 pt-4 border-t border-gray-100 text-center">
                                <a href="#" class="text-sm text-indigo-600 font-medium hover:underline">Lihat Laporan Lengkap</a>
                            </div>
                        </div>

                        {{-- 4. RECENT ACTIVITY (FEED) --}}
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-5">Aktivitas Terakhir</h3>
                            
                            <ul class="space-y-6 border-l-2 border-gray-100 ml-2">
                                <li class="relative pl-6">
                                    <span class="absolute -left-1.5 top-1.5 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
                                    <p class="text-sm text-gray-800 font-medium">Pesanan Baru #ORD-2023</p>
                                    <p class="text-xs text-gray-500">2 menit yang lalu</p>
                                </li>
                                <li class="relative pl-6">
                                    <span class="absolute -left-1.5 top-1.5 w-3 h-3 bg-blue-500 rounded-full border-2 border-white"></span>
                                    <p class="text-sm text-gray-800 font-medium">Produk Diperbarui</p>
                                    <p class="text-xs text-gray-500">Ubah harga "iPhone 11"</p>
                                    <p class="text-xs text-gray-400 mt-0.5">1 jam yang lalu</p>
                                </li>
                                <li class="relative pl-6">
                                    <span class="absolute -left-1.5 top-1.5 w-3 h-3 bg-yellow-500 rounded-full border-2 border-white"></span>
                                    <p class="text-sm text-gray-800 font-medium">Peringatan Stock rendah</p>
                                    <p class="text-xs text-gray-500">Laptop ASUS tersisa: 2</p>
                                    <p class="text-xs text-gray-400 mt-0.5">5 Jam Yang Lalu</p>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection