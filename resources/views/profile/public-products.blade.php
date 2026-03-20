@extends('layouts.app')

@section('title', 'Katalog ' . $user->name)

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

        {{-- HEADER: Profil Penjual --}}
        <div class="bg-white border border-slate-100 rounded-[2.5rem] p-8 shadow-sm mb-10">
            <div class="flex flex-col sm:flex-row items-center gap-6">
                <div class="relative">
                    <img src="{{ $user->avatar ?? asset('images/avatar-placeholder.png') }}"
                        class="w-24 h-24 rounded-[2rem] object-cover bg-slate-50 border-4 border-white shadow-md">
                    <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 border-4 border-white rounded-full"></div>
                </div>

                <div class="text-center sm:text-left flex-1">
                    <p class="text-[10px] font-black text-luno-primary uppercase tracking-[0.2em] mb-1">Katalog Produk</p>
                    <h1 class="text-3xl font-black text-slate-800 tracking-tight mb-2">
                        Semua Barang <span class="text-luno-primary">{{ $user->name }}</span>
                    </h1>
                    <div class="flex flex-wrap justify-center sm:justify-start gap-4 mt-4">
                        <a href="{{ route('public.profile', $user->id) }}"
                            class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-luno-primary transition-colors group">
                            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M10 19l-7-7 7-7" />
                            </svg>
                            KEMBALI KE PROFIL
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- LIST PRODUK --}}
        @if ($products->count())
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <a href="{{ route('products.show', $product->id) }}"
                        class="group bg-white border border-slate-100 rounded-[2rem] p-4 shadow-sm hover:shadow-xl hover:shadow-blue-900/5 transition-all duration-500 hover:-translate-y-2">

                        {{-- Image Container --}}
                        <div class="aspect-[4/3] mb-4 bg-slate-50 rounded-[1.5rem] overflow-hidden relative">
                            <img src="{{ $product->images->first()
                                ? asset('storage/' . $product->images->first()->image_path)
                                : asset('images/placeholder-product.jpg') }}"
                                class="w-full h-full object-contain group-hover:scale-110 transition duration-700"
                                alt="{{ $product->nama_barang }}">
                            {{-- Overlay Badge --}}
                            <div class="absolute top-3 right-3">
                                <span
                                    class="bg-white/90 backdrop-blur-md text-[9px] font-black px-3 py-1.5 rounded-full shadow-sm text-slate-800 uppercase tracking-tighter">
                                    Tersedia
                                </span>
                            </div>
                        </div>

                        {{-- Product Info --}}
                        <div class="px-2 pb-2">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">
                                {{ $product->category->name ?? 'Produk' }}
                            </p>
                            <h3
                                class="font-bold text-slate-800 text-sm line-clamp-1 group-hover:text-luno-primary transition-colors mb-2">
                                {{ $product->nama_barang }}
                            </h3>

                            <div class="flex items-center justify-between mt-auto">
                                <p class="text-base font-black text-slate-900">
                                    <span
                                        class="text-[10px] font-bold">Rp</span>{{ number_format($product->harga, 0, ',', '.') }}
                                </p>
                                <div
                                    class="w-8 h-8 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-luno-primary group-hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M14 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-white border border-dashed border-slate-200 rounded-[2.5rem]">
                <div
                    class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <p class="text-slate-500 font-bold">Penjual ini belum memiliki barang lain.</p>
            </div>
        @endif

    </div>

    <style>
        /* Scroll Halus */
        html {
            scroll-behavior: smooth;
        }

        /* Utility class*/
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
