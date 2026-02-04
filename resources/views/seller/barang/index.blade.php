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

                            @forelse ($barangs as $barang)
                                <tr>
                                    <td class="px-3 py-3 flex items-center gap-3">
<div class="w-12 h-12 rounded overflow-hidden bg-gray-100">
    @if ($barang->images->count())
        <img
            src="{{ asset('storage/' . $barang->images->first()->image_path) }}"
            alt="{{ $barang->nama_barang }}"
            class="w-full h-full object-cover"
        >
    @else
        <div class="w-full h-full flex items-center justify-center text-xs text-gray-400">
            No Image
        </div>
    @endif
</div>

                                        <div>
                                            <p class="font-medium">{{ $barang->nama_barang }}</p>
                                            <p class="text-xs text-gray-500">
                                                Dibuat: {{ $barang->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </td>

                                    <td class="px-3 py-3">
                                        Rp {{ number_format($barang->harga, 0, ',', '.') }}
                                    </td>

                                    <td class="px-3 py-3">
                                        {{ $barang->stok }}
                                    </td>

                                    <td class="px-3 py-3">
                                        @if ($barang->status === 'tersedia')
                                            <span class="text-green-600 font-medium">Aktif</span>
                                        @else
                                            <span class="text-gray-500 font-medium">Nonaktif</span>
                                        @endif
                                    </td>



                                    <td class="px-3 py-3 text-right">
                                        <div class="flex justify-end gap-3">

                                            {{-- LIHAT --}}
                                            <a href="{{ route('seller.products.show', $barang->id) }}"
                                                class="text-blue-600 hover:underline">
                                                Lihat
                                            </a>

                                            {{-- EDIT --}}
                                            <a href="{{ route('seller.products.edit', $barang->id) }}"
                                                class="text-green-600 hover:underline">
                                                Edit
                                            </a>

                                            {{-- HAPUS --}}
                                            <form action="{{ route('seller.products.destroy', $barang->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="text-red-600 hover:underline">
                                                    Hapus
                                                </button>
                                                </form>
                                             </tr>
                                            @empty
                                <tr>
                                    <td colspan="5" class="px-3 py-6 text-center text-gray-500">
                                        Belum ada produk
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>

            </div>

        </div>

    </div>
@endsection