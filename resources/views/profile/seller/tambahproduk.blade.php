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
                        {{ request()->routeIs('seller.products','seller.produksaya')}}">
                        Produk Saya
                        </a>

                        <a href="{{ route('seller.addproduct') }}"
                        class="block
                        {{ request()->routeIs('seller.addproduct','seller.tambahproduk')
                            ? 'font-bold text-black'
                            : 'text-gray-600' }}">
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
                Tambahkan Produk Baru
            </h1>

            <form class="space-y-6">

                {{-- Nama Produk --}}
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Nama Produk
                    </label>
                    <input type="text"
                        placeholder="Contoh: iPhone 11 64GB"
                        class="w-full border rounded px-3 py-2 focus:outline-none">
                </div>

                {{-- Harga & Stok --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Harga
                        </label>
                        <input type="number"
                            placeholder="4500000"
                            class="w-full border rounded px-3 py-2 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Stok
                        </label>
                        <input type="number"
                            placeholder="0"
                            class="w-full border rounded px-3 py-2 focus:outline-none">
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Deskripsi Produk
                    </label>
                    <textarea rows="5"
                            placeholder="Jelaskan kondisi produk, kelengkapan, minus, dll."
                            class="w-full border rounded px-3 py-2 focus:outline-none"></textarea>
                    <p class="text-xs text-gray-500 mt-1">
                        Tulis deskripsi yang jelas agar pembeli percaya.
                    </p>
                </div>

                {{-- Foto Produk --}}
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Foto Produk
                    </label>
                    <input type="file"
                        class="block w-full text-sm text-gray-600">
                    <p class="text-xs text-gray-500 mt-1">
                        Gunakan foto asli, jelas, dan tidak blur.
                    </p>
                </div>

                {{-- Status Produk --}}
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Status Produk
                    </label>
                    <select class="w-full border rounded px-3 py-2">
                        <option>Aktif (langsung dijual)</option>
                        <option>Nonaktif (simpan dulu)</option>
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-3">
                    <button type="button"
                            class="px-4 py-2 border rounded">
                        Batal
                    </button>

                    <button type="submit"
                            class="px-4 py-2 bg-black text-white rounded">
                        Simpan Produk
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>
@endsection
