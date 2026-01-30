@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6">

        <div class="grid grid-cols-12 gap-6">

            {{-- KIRI (SAMA DENGAN INDEX & EDIT) --}}
            <div class="col-span-3">
                <div class="space-y-6 text-sm">

                    <div>
                        <p class="font-semibold">Pesanan</p>
                        <div class="ml-3 mt-2">
                            <a href="{{ route('seller.orders') }}"
                                class="block {{ request()->routeIs('seller.orders') ? 'font-bold text-black' : 'text-gray-600' }}">
                                Daftar Pesanan
                            </a>
                        </div>
                    </div>

                    <div>
                        <p class="font-semibold">Produk</p>
                        <div class="ml-3 mt-2 space-y-1">
                            <a href="{{ route('seller.products') }}" class="block font-bold text-black">
                                Produk Saya
                            </a>

                            <a href="{{ route('seller.products.create') }}" class="block text-gray-600">
                                Tambahkan Produk Baru
                            </a>
                        </div>
                    </div>

                    <div>
                        <p class="font-semibold">Statistik</p>
                        <div class="ml-3 mt-2">
                            <a href="{{ route('seller.statistics') }}" class="block text-gray-600">
                                Statistik Penjualan
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- KANAN --}}
            <div class="col-span-9 bg-white rounded p-6">

                {{-- HEADER --}}
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-xl font-semibold">
                        Detail Produk
                    </h1>

                </div>

                {{-- DETAIL --}}
                <div class="space-y-4 text-sm">

                    <div>
                        <p class="text-gray-500">Nama Produk</p>
                        <p class="font-medium">{{ $barang->nama_barang }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Kategori</p>
                        <p class="font-medium">{{ $barang->kategori->nama_kategori }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Harga</p>
                        <p class="font-medium">
                            Rp {{ number_format($barang->harga, 0, ',', '.') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Stok</p>
                        <p class="font-medium">{{ $barang->stok }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Status</p>
                        <p class="font-medium">
                            @if ($barang->status === 'tersedia')
                                <span class="text-green-600">Aktif</span>
                            @else
                                <span class="text-gray-500">Nonaktif</span>
                            @endif
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Deskripsi</p>
                        <p class="whitespace-pre-line">{{ $barang->deskripsi }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Dibuat</p>
                        <p>{{ $barang->created_at->format('d M Y H:i') }}</p>
                    </div>

                    {{-- TOMBOL --}}
                    <div class="flex justify-end gap-3 pt-6">
                        <a href="{{ route('seller.products') }}" class="px-4 py-2 border rounded">
                            Batal
                        </a>
                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection
