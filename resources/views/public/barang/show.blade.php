@extends('Layouts.app')

@section('title', $product['name'])

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- ================= LEFT : FOTO + PREVIEW (SATU WRAPPER) ================= --}}
            <div class="lg:col-span-8">
                <div x-data="{
                    active: 0,
                    zoom: false,
                    images: @js($product['images']),
                    prev() {
                        this.active = this.active === 0 ?
                            this.images.length - 1 :
                            this.active - 1
                    },
                    next() {
                        this.active = this.active === this.images.length - 1 ?
                            0 :
                            this.active + 1
                    }
                }" class="border rounded-lg bg-white p-4 space-y-3">

                    {{-- FOTO UTAMA + PANAH --}}
                    <div class="relative rounded">

                        {{-- INNER WRAPPER (BIAR FOTO KECILIN) --}}
                        <div class="px-12 py-4">
                            <img :src="images[active]" @click="zoom = true"
                                class="w-full aspect-[4/3] object-cover rounded bg-gray-100 cursor-zoom-in" alt="Foto Produk">

                        </div>

                        {{-- PANAH KIRI --}}
                        <button @click="prev"
                            class="absolute left-4 top-1/2 -translate-y-1/2
                            w-14 h-14 rounded-full
                            bg-white shadow-lg
                            flex items-center justify-center
                            text-2xl font-bold
                            hover:bg-gray-100 transition">
                            ‹
                        </button>

                        {{-- PANAH KANAN --}}
                        <button @click="next"
                            class="absolute right-4 top-1/2 -translate-y-1/2
                            w-14 h-14 rounded-full
                            bg-white shadow-lg
                            flex items-center justify-center
                            text-2xl font-bold
                            hover:bg-gray-100 transition">
                            ›
                        </button>

                    </div>


                    {{-- PREVIEW / THUMBNAIL (DALAM WRAPPER YANG SAMA) --}}
                    <div class="flex gap-3 overflow-x-auto py-2 px-1 scrollbar-hide">
                        <template x-for="(img, index) in images" :key="index">
                            <button @click="active = index"
                                class="flex-shrink-0 w-24 aspect-[4/3]
           border rounded overflow-hidden
           transition
           hover:scale-105 hover:shadow-md"
                                :class="active === index ? 'outline outline-2 outline-blue-600' : ''">

                                <img :src="img" class="w-full h-full object-cover bg-gray-100">
                            </button>
                        </template>
                    </div>

                    <!-- ZOOM MODAL -->
                    <div x-show="zoom" x-transition @click.self="zoom = false"
                        class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-6">
                        <!-- CLOSE BUTTON -->
                        <button @click="zoom = false"
                            class="absolute top-6 right-6
               w-10 h-10 rounded-full
               bg-white text-black text-xl
               flex items-center justify-center
               hover:bg-gray-200">
                            ✕
                        </button>

                        <!-- IMAGE -->
                        <img :src="images[active]"
                            class="max-w-full max-h-full object-contain
               cursor-zoom-out
               transition-transform duration-300">
                    </div>

                </div>


                {{-- ================= DESKRIPSI PRODUK ================= --}}
                <div x-data="{ open: false }" class="border rounded-lg bg-white p-4 relative">
                    <h2 class="font-semibold mb-2">Deskripsi</h2>

                    {{-- TEKS + FADE --}}
                    <div class="relative">
                        <div class="text-sm text-gray-700 leading-relaxed" :class="open ? '' : 'line-clamp-3'">
                            {!! nl2br(e($product['description'] ?? '')) !!}
                        </div>

                        {{-- FADE --}}
                        <div x-show="!open"
                            class="pointer-events-none absolute inset-x-0 bottom-0 h-8
                            bg-gradient-to-t from-white to-transparent">
                        </div>
                    </div>

                    {{-- TOGGLE (TENGAH) --}}
                    <div class="flex justify-center">
                        <button x-show="!open" @click="open = true"
                            class="mt-2 text-blue-600 text-sm font-medium hover:underline">
                            Selengkapnya
                        </button>

                        <button x-show="open" @click="open = false"
                            class="mt-2 text-blue-600 text-sm font-medium hover:underline">
                            Tutup
                        </button>
                    </div>
                </div>

            </div>

            {{-- ================= RIGHT COLUMN ================= --}}
            <div class="lg:col-span-4 space-y-4">

                {{-- ===== WRAPPER 1: DETAIL PRODUK ===== --}}
                <div class="border rounded-lg bg-white p-4 space-y-4">

                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-2xl font-bold">
                                Rp {{ number_format($product['price'], 0, ',', '.') }}
                            </p>

                            <h1 class="text-lg font-semibold leading-snug">
                                {{ $product['name'] }}
                            </h1>

                            <p class="text-sm text-gray-500">
                                {{ $product['location'] }}
                            </p>
                        </div>

                        <div class="flex gap-2 pt-1">
                            <button class="w-8 h-8 border rounded-full hover:bg-gray-100">🔗</button>
                            <button class="w-8 h-8 border rounded-full hover:bg-gray-100">❤️</button>
                        </div>
                    </div>

                    <hr>

<a
    href="{{ route('buyer.checkout', $product['id']) }}"
    class="block w-full text-center bg-blue-600 text-white py-3 rounded font-semibold
    hover:bg-blue-700 transition">
    BELI
</a>


                </div>

                {{-- ===== WRAPPER 2: USER / PENJUAL ===== --}}
                <div class="border rounded-lg bg-white p-4 space-y-4">

                    <div class="flex items-center gap-3">
                        <a href="/user/{{ $product['user']['id'] }}">
                            <img src="{{ $product['user']['avatar'] }}"
                                class="w-12 h-12 rounded-full object-cover bg-gray-100">
                        </a>

                        <div class="flex-1">
                            <a href="{{ route('public.profile', $product['user']['id']) }}"
                                class="font-semibold hover:underline">
                                {{ $product['user']['name'] }}
                            </a>
                            <p class="text-xs text-gray-500">Penjual</p>
                        </div>
                    </div>

                    <button
                        class="w-full bg-blue-600 text-white py-2 rounded font-semibold
                        hover:bg-blue-700 transition"
                        data-open-chat="true" data-user-id="{{ $product['user']['id'] }}">
                        Chat Penjual
                    </button>
                    {{-- LIHAT BARANG SELLER --}}
                    <a href="{{ route('public.profile.products', $product['user']['id']) }}"
                        class="block w-full text-center border py-2 rounded text-sm
    hover:bg-gray-50 transition">
                        Lihat Barang Lain
                    </a>



                </div>

                {{-- ================= MAP AREA (COVERAGE ONLY | 4:3) ================= --}}
                <div class="border rounded-lg bg-white p-2">

                    <div id="map" class="relative w-full aspect-[4/3] rounded overflow-hidden bg-gray-100">
                        {{-- DUMMY MAP GRID --}}
                        <div
                            class="absolute inset-0 bg-[radial-gradient(circle_at_center,#e5e7eb_1px,transparent_1px)] bg-[size:16px_16px]">
                        </div>

                        {{-- AREA LINGKARAN (COVERAGE) --}}
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div
                                class="w-48 h-48 rounded-full
                                bg-blue-500/20
                                border border-blue-500/40">
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- ================= ULASAN PENJUAL ================= --}}
        <div class="mt-8 border rounded-lg bg-white p-4">

            {{-- HEADER --}}
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-semibold">
                    Ulasan Penjual
                </h2>

                <a href="#" class="text-sm text-blue-600 hover:underline">
                    Lihat Ulasan Lain
                </a>
            </div>

            {{-- LIST ULASAN (HORIZONTAL) --}}
            <div class="flex gap-4 overflow-x-auto pb-2 scrollbar-hide">

                @foreach ($ratings as $rating)
                    <div class="min-w-[260px] border rounded-lg p-3 flex-shrink-0">

                        {{-- HEADER --}}
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-sm font-medium">
                                {{ $rating['initial'] }}
                            </p>

                            {{-- BINTANG (LEBIH BESAR) --}}
                            <div class="flex text-yellow-400 text-lg leading-none">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($rating['star'] >= $i)
                                        ★
                                    @elseif ($rating['star'] >= $i - 0.5)
                                        ☆
                                    @else
                                        <span class="text-gray-300">★</span>
                                    @endif
                                @endfor
                            </div>
                        </div>

                        {{-- PRODUK --}}
                        <p class="text-xs text-gray-500 mb-1">
                            {{ $rating['product'] }}
                        </p>

                        {{-- KOMENTAR --}}
                        <p class="text-sm text-gray-700 leading-snug line-clamp-3">
                            {{ $rating['comment'] }}
                        </p>

                    </div>
                @endforeach

            </div>
        </div>

    </div>
@endsection
