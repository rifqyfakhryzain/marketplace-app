@extends('layouts.app')

@section('content')
    {{-- Banner Promosi --}}
    @include('components.ads-slider')

    {{-- Section Kategori --}}
    <div class="mb-12">
        @include('components.categories', ['categories' => $categories])
    </div>

    {{-- SECTION: BARU DIUNGGAH (Sekarang Full Grid) --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 mb-16">
        <div class="flex justify-between items-end mb-8">
            <div class="space-y-1">
                <h2 class="text-2xl font-black tracking-tight text-slate-800 sm:text-3xl">
                    Baru <span class="text-luno-primary">Diunggah</span>
                </h2>
                <p class="text-[11px] sm:text-sm font-medium text-slate-400 uppercase tracking-wider">
                    Koleksi thrifting terbaru hari ini
                </p>
            </div>
            
            <a href="#" class="flex items-center text-xs sm:text-sm font-black text-luno-primary hover:bg-blue-50 px-3 py-2 rounded-xl transition-all group">
                Lihat Semua 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        {{-- Grid System: Disamakan persis dengan Rekomendasi --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 sm:gap-6">
            @foreach ($products as $product)
                @include('components.product-card', [
                    'product' => $product,
                    'horizontal' => false
                ])
            @endforeach
        </div>
    </div>

    {{-- SECTION: REKOMENDASI --}}
    {{-- Pastikan di file rekomendasi.blade.php menggunakan struktur grid yang sama --}}
    @include('components.rekomendasi', ['products' => $rekomendasi])

@endsection