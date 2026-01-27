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
                        {{ request()->routeIs('seller.orders','seller.pesanan')}}">
                            Daftar Pesanan
                        </a>
                    </div>
                </div>

                <div>
                    <p class="font-semibold">Produk</p>
                    <div class="ml-3 mt-2 space-y-1">
                        <a href="{{ route('seller.products') }}"
                        class="block
                        {{ request()->routeIs('seller.products','seller.produksaya')
                            ? 'font-bold text-black'
                            : 'text-gray-600' }}">
                        Produk Saya
                        </a>

<a href="{{ route('seller.products.create') }}">                        class="block
                        {{ request()->routeIs('seller.addproduct','seller.tambahproduk')}}">
                            Tambahkan Produk Baru
                        </a>
                    </div>
                </div>

                <div>
                    <p class="font-semibold">Statistik</p>
                    <div class="ml-3 mt-2">
                        <a href="{{ route('seller.statistics') }}"
                        class="block
                        {{ request()->routeIs('seller.statistics')}}">
                            Statistik Penjualan
                        </a>
                    </div>
                </div>

            </div>
        </div>

        {{-- KANAN --}}
        <div class="col-span-9 bg-white rounded p-6">

            <h1 class="text-xl font-semibold mb-6">
                Produk Saya
            </h1>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-500">
                            <th class="px-3 py-2 text-left font-medium">Produk</th>
                            <th class="px-3 py-2 text-left font-medium">Harga</th>
                            <th class="px-3 py-2 text-left font-medium">Stok</th>
                            <th class="px-3 py-2 text-left font-medium">Status</th>
                            <th class="px-3 py-2 text-right font-medium">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        {{-- PRODUK 1 --}}
                        <tr>
                            <td class="px-3 py-3 flex items-center gap-3">
                                <div class="w-12 h-12 bg-gray-200 rounded"></div>
                                <div>
                                    <p class="font-medium">iPhone 11</p>
                                    <p class="text-xs text-gray-500">
                                        Dibuat: 25 Jan 2026
                                    </p>
                                </div>
                            </td>
                            <td class="px-3 py-3">Rp 4.500.000</td>
                            <td class="px-3 py-3">3</td>
                            <td class="px-3 py-3">
                                <span class="text-green-600 font-medium">
                                    Aktif
                                </span>
                            </td>
                            <td class="px-3 py-3 text-right">
                                <a href="#"
                                class="text-blue-600 hover:underline">
                                    Edit
                                </a>
                            </td>
                        </tr>

                        {{-- PRODUK 2 --}}
                        <tr>
                            <td class="px-3 py-3 flex items-center gap-3">
                                <div class="w-12 h-12 bg-gray-200 rounded"></div>
                                <div>
                                    <p class="font-medium">Laptop ASUS</p>
                                    <p class="text-xs text-gray-500">
                                        Dibuat: 20 Jan 2026
                                    </p>
                                </div>
                            </td>
                            <td class="px-3 py-3">Rp 7.200.000</td>
                            <td class="px-3 py-3">0</td>
                            <td class="px-3 py-3">
                                <span class="text-red-600 font-medium">
                                    Habis
                                </span>
                            </td>
                            <td class="px-3 py-3 text-right">
                                <a href="#"
                                class="text-blue-600 hover:underline">
                                    Edit
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>

    </div>

</div>
@endsection
