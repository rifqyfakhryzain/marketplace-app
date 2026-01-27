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
                        {{ request()->routeIs('seller.orders','seller.pesanan')
                            ? 'font-bold text-black'
                            : 'text-gray-600' }}">
                        Daftar Pesanan
                        </a>
                    </div>
                </div>

                <div>
                    <p class="font-semibold">Produk</p>
                    <div class="ml-3 mt-2 space-y-1">
                        <a href="{{ route('seller.products') }}"
                        class="block
                        {{ request()->routeIs('seller.products','seller.produksaya')}}">
                        Produk Saya
                        </a>

                        <a href="{{ route('seller.addproduct') }}"
                        class="block
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
                Daftar Pesanan
            </h1>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-500">
                            <th class="px-3 py-2 text-left font-medium">Kode</th>
                            <th class="px-3 py-2 text-left font-medium">Tanggal</th>
                            <th class="px-3 py-2 text-left font-medium">Pembeli</th>
                            <th class="px-3 py-2 text-left font-medium">Produk</th>
                            <th class="px-3 py-2 text-left font-medium">Total</th>
                            <th class="px-3 py-2 text-left font-medium">Status</th>
                            <th class="px-3 py-2 text-right font-medium">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        <tr>
                            <td class="px-3 py-3">ORD-001</td>
                            <td class="px-3 py-3">25 Jan 2026</td>
                            <td class="px-3 py-3">Hennessy</td>
                            <td class="px-3 py-3">iPhone 11</td>
                            <td class="px-3 py-3">Rp 4.500.000</td>
                            <td class="px-3 py-3">
                                <span class="font-medium text-yellow-600">
                                    Menunggu Pembayaran
                                </span>
                            </td>
                            <td class="px-3 py-3 text-right">
                                <button class="text-blue-600 hover:underline">
                                    Detail
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td class="px-3 py-3">ORD-002</td>
                            <td class="px-3 py-3">24 Jan 2026</td>
                            <td class="px-3 py-3">Andi</td>
                            <td class="px-3 py-3">Laptop ASUS</td>
                            <td class="px-3 py-3">Rp 7.200.000</td>
                            <td class="px-3 py-3">
                                <span class="font-medium text-blue-600">
                                    Diproses
                                </span>
                            </td>
                            <td class="px-3 py-3 text-right">
                                <button class="text-blue-600 hover:underline">
                                    Detail
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td class="px-3 py-3">ORD-003</td>
                            <td class="px-3 py-3">23 Jan 2026</td>
                            <td class="px-3 py-3">Budi</td>
                            <td class="px-3 py-3">+2 Produk</td>
                            <td class="px-3 py-3">Rp 1.850.000</td>
                            <td class="px-3 py-3">
                                <span class="font-medium text-green-600">
                                    Selesai
                                </span>
                            </td>
                            <td class="px-3 py-3 text-right">
                                <button class="text-blue-600 hover:underline">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</div>
@endsection
