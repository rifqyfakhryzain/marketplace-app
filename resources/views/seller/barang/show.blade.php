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

{{-- GAMBAR PRODUK --}}
{{-- GAMBAR PRODUK --}}
<div class="mb-8">

    <p class="text-gray-500 mb-2">Gambar Produk</p>

    @if ($barang->images->count())

    <div class="relative w-full max-w-md">

        {{-- GAMBAR UTAMA --}}
        <div class="relative group aspect-square bg-gray-100 rounded-lg overflow-hidden border">

            <img
                id="mainImage"
                src="{{ asset('storage/' . $barang->images->first()->image_path) }}"
                class="w-full h-full object-cover transition duration-300"
            >

            {{-- OVERLAY (HOVER) --}}
            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition"></div>

            {{-- BUTTON LEFT --}}
            <button
                onclick="prevImage()"
                class="absolute left-2 top-1/2 -translate-y-1/2
                       bg-white/80 hover:bg-white p-2 rounded-full shadow
                       opacity-0 group-hover:opacity-100 transition"
            >
                ◀
            </button>

            {{-- BUTTON RIGHT --}}
            <button
                onclick="nextImage()"
                class="absolute right-2 top-1/2 -translate-y-1/2
                       bg-white/80 hover:bg-white p-2 rounded-full shadow
                       opacity-0 group-hover:opacity-100 transition"
            >
                ▶
            </button>
        </div>

        {{-- THUMBNAIL --}}
        <div
            id="thumbContainer"
            class="flex gap-3 mt-4 overflow-x-hidden"
        >
            @foreach ($barang->images as $index => $image)
                <button
                    onclick="setImage({{ $index }})"
                    class="thumb w-20 h-20 flex-shrink-0 border rounded-md overflow-hidden
                           hover:ring-2 hover:ring-blue-500 transition"
                >
                    <img
                        src="{{ asset('storage/' . $image->image_path) }}"
                        class="w-full h-full object-cover"
                    >
                </button>
            @endforeach
        </div>
    </div>

    @else
        <p class="text-sm text-gray-400">Produk ini belum memiliki gambar.</p>
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

<script>
    const images = @json(
        $barang->images->map(fn($img) => asset('storage/' . $img->image_path))
    );

    let currentIndex = 0;

    function setImage(index) {
        currentIndex = index;
        document.getElementById('mainImage').src = images[currentIndex];
        updateActiveThumb();
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % images.length;
        setImage(currentIndex);
    }

    function prevImage() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        setImage(currentIndex);
    }

    function updateActiveThumb() {
        document.querySelectorAll('.thumb').forEach((el, i) => {
            el.classList.toggle('ring-2', i === currentIndex);
            el.classList.toggle('ring-blue-500', i === currentIndex);
        });
    }

    updateActiveThumb();
</script>


