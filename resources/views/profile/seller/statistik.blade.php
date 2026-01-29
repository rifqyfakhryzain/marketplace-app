@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6">

        <div class="grid grid-cols-12 gap-6">

            {{-- KIRI --}}
            <div class="col-span-3">
                <div class="space-y-6 text-sm">

                    <div>
                        <p class="font-semibold">Pesanan</p>
                        <div class="ml-3 mt-2">
                            <a href="{{ route('seller.orders') }}"
                                class="block
           {{ request()->routeIs('seller.orders') ? 'font-bold text-black' : 'text-gray-600' }}">
                                Daftar Pesanan
                            </a>
                        </div>
                    </div>

                    <div>
                        <p class="font-semibold">Produk</p>
                        <div class="ml-3 mt-2 space-y-1">
                            <a href="{{ route('seller.products') }}"
                                class="block
           {{ request()->routeIs('seller.products') ? 'font-bold text-black' : 'text-gray-600' }}">
                                Produk Saya
                            </a>

                            <a href="{{ route('seller.products.create') }}"
                                class="block
           {{ request()->routeIs('seller.products.create') ? 'font-bold text-black' : 'text-gray-600' }}">
                                Tambahkan Produk Baru
                            </a>
                        </div>
                    </div>

                    <div>
                        <p class="font-semibold">Statistik</p>
                        <div class="ml-3 mt-2">
                            <a href="{{ route('seller.statistics') }}"
                                class="block
           {{ request()->routeIs('seller.statistics') ? 'font-bold text-black' : 'text-gray-600' }}">
                                Statistik Penjualan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KANAN --}}
            <div class="col-span-9 bg-white rounded p-6">

                <h1 class="text-xl font-semibold mb-6">
                    Statistik Penjualan
                </h1>

                {{-- RINGKASAN --}}
                <div class="grid grid-cols-4 gap-4 mb-8">
                    <div>
                        <p class="text-sm text-gray-500">Total Pendapatan</p>
                        <p class="text-lg font-semibold">Rp 12.450.000</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Total Pesanan</p>
                        <p class="text-lg font-semibold">28</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Produk Terjual</p>
                        <p class="text-lg font-semibold">19</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Produk Aktif</p>
                        <p class="text-lg font-semibold">6</p>
                    </div>
                </div>

                {{-- STATISTIK WAKTU --}}
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div class="p-4 bg-gray-50 rounded">
                        <p class="text-sm text-gray-500">Pendapatan Bulan Ini</p>
                        <p class="text-lg font-semibold mt-1">Rp 3.200.000</p>
                    </div>

                    <div class="p-4 bg-gray-50 rounded">
                        <p class="text-sm text-gray-500">Pesanan Hari Ini</p>
                        <p class="text-lg font-semibold mt-1">2</p>
                    </div>
                </div>

                {{-- PRODUK TERLARIS --}}
                <div class="mb-8">
                    <h2 class="text-sm font-semibold mb-3">
                        Produk Terlaris
                    </h2>

                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-gray-500">
                                <th class="text-left py-2 font-medium">Produk</th>
                                <th class="text-left py-2 font-medium">Terjual</th>
                                <th class="text-left py-2 font-medium">Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr>
                                <td class="py-2">iPhone 11</td>
                                <td class="py-2">5</td>
                                <td class="py-2">Rp 22.500.000</td>
                            </tr>
                            <tr>
                                <td class="py-2">Laptop ASUS</td>
                                <td class="py-2">3</td>
                                <td class="py-2">Rp 21.600.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- STATUS PESANAN --}}
                <div>
                    <h2 class="text-sm font-semibold mb-3">
                        Status Pesanan
                    </h2>

                    <div class="flex gap-6 text-sm">
                        <p>Menunggu Pembayaran: <span class="font-semibold">3</span></p>
                        <p>Diproses: <span class="font-semibold">4</span></p>
                        <p>Dikirim: <span class="font-semibold">2</span></p>
                        <p>Selesai: <span class="font-semibold">19</span></p>
                    </div>
                </div>

            </div>


        </div>

    </div>
@endsection
