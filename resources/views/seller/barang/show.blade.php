@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6">

        <div class="grid grid-cols-12 gap-6">

            {{-- LEFT SIDEBAR: NAVIGATION --}}
            <div class="lg:col-span-3">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden sticky top-6">
                    {{-- User Short Profile --}}
                    <div class="p-4 border-b border-gray-100 bg-gray-50">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
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

            {{-- KANAN: KONTEN UTAMA --}}
            <div class="col-span-12 md:col-span-9 space-y-6">

                {{-- SECTION 1: HEADER & ACTIONS --}}
                <div
                    class="bg-white rounded-lg shadow-sm p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                            <a href="{{ route('seller.products') }}" class="hover:text-blue-600">Produk</a>
                            <span>/</span>
                            <span>Detail</span>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $barang->nama_barang }}</h1>
                    </div>

                    <div class="flex gap-3">
                        {{-- Tombol Edit --}}
                        <a href="{{ route('seller.products.edit', $barang->id) }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-50 text-yellow-700 border border-yellow-200 rounded-md font-medium hover:bg-yellow-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Produk
                        </a>

                        {{-- Tombol Hapus (Contoh Form) --}}
                        <form action="{{ route('seller.products.destroy', $barang->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-white text-red-600 border border-red-200 rounded-md font-medium hover:bg-red-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>

                {{-- SECTION 2: STATISTIK RINGKAS (Opsional / Placeholder) --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-blue-500">
                        <p class="text-gray-500 text-sm">Total Terjual</p>
                        <p class="text-2xl font-bold text-gray-800">0 <span
                                class="text-sm font-normal text-gray-400">unit</span></p> {{-- Ganti dengan data real jika ada --}}
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-green-500">
                        <p class="text-gray-500 text-sm">Total Pendapatan</p>
                        <p class="text-2xl font-bold text-gray-800">Rp 0</p> {{-- Ganti dengan data real jika ada --}}
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-purple-500">
                        <p class="text-gray-500 text-sm">Status Stok</p>
                        <p class="text-2xl font-bold {{ $barang->stok < 5 ? 'text-red-600' : 'text-gray-800' }}">
                            {{ $barang->stok }}
                        </p>
                    </div>
                </div>


                {{-- GAMBAR PRODUK --}}
                <div class="mb-6">
                    <p class="text-gray-500 mb-2">Gambar Produk</p>

                    @if ($barang->images->count())
                        <div class="grid grid-cols-4 gap-4">
                            @foreach ($barang->images as $image)
                                <div class="w-full aspect-square bg-gray-100 rounded overflow-hidden">
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                        alt="{{ $barang->nama_barang }}" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-gray-400 text-sm">
                            Produk ini belum memiliki gambar.
                        </div>
                    @endif
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

                    <hr class="border-gray-100">

                    {{-- Harga --}}
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Harga Satuan</p>
                        <p class="text-3xl font-bold text-gray-900">
                            Rp {{ number_format($barang->harga, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- Stok --}}
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Stok Gudang</p>
                        <div class="flex items-center gap-2">
                            <span class="font-semibold text-lg">{{ $barang->stok }}</span>
                            <span class="text-gray-500 text-sm">unit tersedia</span>

                            @if ($barang->stok < 5)
                                <span class="text-xs text-red-600 font-medium bg-red-50 px-2 py-1 rounded">Stok
                                    Menipis</span>
                            @endif
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    {{-- Deskripsi --}}
                    <div>
                        <p class="text-sm font-semibold text-gray-700 mb-2">Deskripsi Produk</p>
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-100">
                            <p class="whitespace-pre-line text-gray-600 text-sm leading-relaxed">
                                {{ $barang->deskripsi }}
                            </p>
                        </div>
                    </div>

                    {{-- Meta Data --}}
                    <div class="pt-4 flex items-center justify-between text-xs text-gray-400">
                        <span>Dibuat: {{ $barang->created_at->format('d M Y, H:i') }}</span>
                        <span>Terakhir update: {{ $barang->updated_at->format('d M Y, H:i') }}</span>
                    </div>

                </div>
            </div>
        </div>

        {{-- FOOTER / BACK BUTTON --}}
        <div class="flex justify-start">
            <a href="{{ route('seller.products') }}"
                class="text-gray-500 hover:text-gray-700 font-medium flex items-center gap-1 text-sm">
                ← Kembali ke Daftar Produk
            </a>
        </div>

    </div>
    </div>
    </div>
@endsection
