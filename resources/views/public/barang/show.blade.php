@extends('Layouts.app')

@section('title', $product['name'] ?? 'Detail Produk')

@section('content')
    {{-- CSS TAMBAHAN UNTUK FIX LEAFLET & SCROLL --}}
    <style>
        /* Mencegah peta (leaflet) muncul di atas modal zoom */
        .leaflet-container, .leaflet-pane, .leaflet-top, .leaflet-bottom {
            z-index: 1 !important;
        }
        /* Hide scrollbar saat zoom aktif */
        .no-scroll { overflow: hidden; }
        /* Style tambahan untuk scrollbar thumbnails */
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- ================= LEFT : FOTO + PREVIEW ================= --}}
            <div class="lg:col-span-8 space-y-6">
                {{-- Alpine.js Data dengan fitur Lock Scroll --}}
                <div x-data="{
                    active: 0,
                    zoom: false,
                    images: @js($product['images']),
                    prev() { this.active = this.active === 0 ? this.images.length - 1 : this.active - 1 },
                    next() { this.active = this.active === this.images.length - 1 ? 0 : this.active + 1 }
                }" 
                x-effect="zoom ? document.body.classList.add('no-scroll') : document.body.classList.remove('no-scroll')"
                class="bg-white border border-slate-100 rounded-[2.5rem] p-6 shadow-sm overflow-hidden">

                    {{-- FOTO UTAMA --}}
                    <div class="relative group">
                        <div class="overflow-hidden rounded-[2rem] bg-slate-50 border border-slate-50">
                            <img :src="images[active]" @click="zoom = true"
                                class="w-full aspect-[4/3] object-contain cursor-zoom-in hover:scale-105 transition duration-500" 
                                alt="Foto Produk">
                        </div>

                        {{-- NAVIGATION PANAH --}}
                        <button @click="prev" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-2xl bg-white/90 backdrop-blur shadow-xl flex items-center justify-center text-slate-800 hover:bg-luno-primary hover:text-white transition-all opacity-0 group-hover:opacity-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button @click="next" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-2xl bg-white/90 backdrop-blur shadow-xl flex items-center justify-center text-slate-800 hover:bg-luno-primary hover:text-white transition-all opacity-0 group-hover:opacity-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>

                    {{-- THUMBNAILS --}}
                    <div class="flex gap-4 overflow-x-auto py-6 scrollbar-hide">
                        <template x-for="(img, index) in images" :key="index">
                            <button @click="active = index"
                                class="flex-shrink-0 w-24 aspect-square rounded-2xl overflow-hidden border-2 transition-all duration-300 shadow-sm"
                                :class="active === index ? 'border-luno-primary ring-4 ring-luno-primary/10' : 'border-transparent opacity-60 hover:opacity-100'">
                                <img :src="img" class="w-full h-full object-cover">
                            </button>
                        </template>
                    </div>

                    {{-- REVISI FULL: ZOOM MODAL (TETAP DI TENGAH & Z-INDEX TINGGI) --}}
                    <div x-show="zoom" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200"
                        class="fixed inset-0 z-[9999] bg-slate-950/90 backdrop-blur-xl flex items-center justify-center p-4 sm:p-10" 
                        style="display: none;"
                        @click.self="zoom = false"
                        @keydown.escape.window="zoom = false">
                        
                        {{-- Tombol Tutup --}}
                        <button @click="zoom = false" class="absolute top-6 right-6 text-white/50 hover:text-white transition-all z-[10000] p-2">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>

                        {{-- Kontainer Gambar --}}
                        <div class="relative w-full h-full flex items-center justify-center" @click.self="zoom = false">
                            <img :src="images[active]" 
                                class="max-w-full max-h-full object-contain rounded-2xl shadow-2xl transition-transform duration-500"
                                x-transition:enter="transition ease-out duration-500"
                                x-transition:enter-start="scale-90 opacity-0"
                                x-transition:enter-end="scale-100 opacity-100">
                        </div>
                    </div>
                </div>

                {{-- DESKRIPSI --}}
                <div x-data="{ open: false }" class="bg-white border border-slate-100 rounded-[2rem] p-8 shadow-sm">
                    <h2 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-4">Deskripsi Produk</h2>
                    <div class="relative">
                        <div class="text-slate-600 leading-relaxed text-sm sm:text-base" :class="open ? '' : 'line-clamp-6'">
                            {!! nl2br(e($product['description'] ?? '')) !!}
                        </div>
                        <div x-show="!open" class="absolute inset-x-0 bottom-0 h-12 bg-gradient-to-t from-white to-transparent pointer-events-none"></div>
                    </div>
                    <button @click="open = !open" class="mt-4 text-sm font-black text-luno-primary hover:text-luno-primary-dark flex items-center gap-1">
                        <span x-text="open ? 'Tampilkan Lebih Sedikit' : 'Baca Selengkapnya'"></span>
                        <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                </div>
            </div>

            {{-- ================= RIGHT COLUMN ================= --}}
            <div class="lg:col-span-4 space-y-6">
                {{-- INFO HARGA --}}
                <div class="bg-white border border-slate-100 rounded-[2.5rem] p-8 shadow-sm space-y-6">
                    <div>
                        <p class="text-4xl font-black tracking-tight text-slate-800 mb-1">
                            <span class="text-lg font-bold">Rp</span>{{ number_format($product['price'], 0, ',', '.') }}
                        </p>
                        <h1 class="text-lg font-bold text-slate-600 leading-tight mb-3">{{ $product['name'] }}</h1>
                        <div class="flex items-center gap-2 text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span class="text-xs font-bold uppercase tracking-wide">{{ $product['location'] ?? 'Bandung, Jawa Barat' }}</span>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('buyer.checkout', $product['id']) }}" class="flex-1 bg-luno-primary text-white py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] text-center hover:bg-luno-primary-dark shadow-xl shadow-blue-100 transition-all active:scale-95">
                            Beli Sekarang
                        </a>
                        <button class="w-14 h-14 border border-slate-100 rounded-2xl flex items-center justify-center text-slate-400 hover:text-rose-500 hover:bg-rose-50 transition-all active:scale-90">❤️</button>
                    </div>
                </div>

                {{-- INFO PENJUAL --}}
                <div class="bg-white border border-slate-100 rounded-[2.5rem] p-8 shadow-sm space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <img src="{{ $product['user']['avatar'] }}" class="w-16 h-16 rounded-[1.25rem] object-cover bg-slate-50 border border-slate-100">
                            <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 border-4 border-white rounded-full shadow-sm"></div>
                        </div>
                        <div class="flex-1">
                            <p class="text-base font-black text-slate-800">{{ $product['user']['name'] }}</p>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Penjual Terpercaya</p>
                        </div>
                    </div>
<div class="grid grid-cols-2 gap-3">
    {{-- Chat Penjual: Pastikan atribut data- tetap ada untuk JS Chat kamu --}}
    <button class="bg-slate-50 text-slate-800 py-3 rounded-2xl font-bold text-xs hover:bg-slate-100 transition"
            data-open-chat="true" 
            data-user-id="{{ $product['user']['id'] }}">
        Chat Penjual
    </button>

    {{-- Produk Lain: Harus menggunakan tag <a> agar href berfungsi --}}
    <a href="{{ route('public.profile.products', $product['user']['id']) }}"
       class="border border-slate-100 text-slate-500 py-3 rounded-2xl font-bold text-xs text-center hover:bg-slate-50 transition block">
        Produk Lain
    </a>
</div>
                </div>

                {{-- MAP (FIXED Z-INDEX) --}}
                <div class="bg-white border border-slate-100 rounded-[2.5rem] p-4 shadow-sm overflow-hidden">
                    <div id="map" class="w-full h-[200px] rounded-[1.75rem] bg-slate-50" 
                        data-lat="{{ $product['user']['latitude'] ?? '' }}" 
                        data-lng="{{ $product['user']['longitude'] ?? '' }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- ULASAN --}}
        <div class="mt-12 bg-white border border-slate-100 rounded-[2.5rem] p-10 shadow-sm">
            <h2 class="text-2xl font-black text-slate-800 tracking-tight mb-8">Ulasan <span class="text-luno-primary">Penjual</span></h2>
            <div class="flex gap-6 overflow-x-auto pb-4 scrollbar-hide">
                @foreach ($ratings as $rating)
                    <div class="min-w-[320px] bg-slate-50/50 border border-slate-100 rounded-3xl p-6 flex-shrink-0">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest bg-white px-3 py-1 rounded-full border border-slate-100">{{ $rating['initial'] }}</span>
                            <div class="flex text-amber-400 text-sm">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span>{{ $rating['star'] >= $i ? '★' : '☆' }}</span>
                                @endfor
                            </div>
                        </div>
                        <p class="text-xs font-bold text-luno-primary mb-2">Produk: {{ $rating['product'] }}</p>
                        <p class="text-sm text-slate-600 italic line-clamp-3">"{{ $rating['comment'] }}"</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection