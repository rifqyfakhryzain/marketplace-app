@extends('layouts.app')

@section('title', 'Barang ' . $user->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">

    {{-- HEADER --}}
    <div class="flex items-center gap-4 mb-6">
        <img
            src="{{ asset('images/avatar-placeholder.png') }}"
            class="w-16 h-16 rounded-full object-cover"
        >
        <div>
            <h1 class="text-xl font-semibold">
                Barang dari {{ $user->name }}
            </h1>
            <a href="{{ route('public.profile', $user->id) }}"
               class="text-sm text-blue-600 hover:underline">
                ← Kembali ke profil
            </a>
        </div>
    </div>

    {{-- LIST PRODUK --}}
    @if ($products->count())
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach ($products as $product)
                <a href="{{ route('products.show', $product->id) }}"
                   class="border rounded-lg p-3 bg-white hover:shadow transition">

                    <div class="aspect-[4/3] mb-2 bg-gray-100 rounded overflow-hidden">
                        <img
                            src="{{ $product->images->first()
                                ? asset('storage/' . $product->images->first()->image_path)
                                : asset('images/placeholder-product.jpg') }}"
                            class="w-full h-full object-cover"
                        >
                    </div>

                    <p class="font-semibold text-sm line-clamp-2">
                        {{ $product->nama_barang }}
                    </p>

                    <p class="text-sm text-blue-600 font-bold">
                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                    </p>
                </a>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">
            Penjual ini belum memiliki barang lain.
        </p>
    @endif

</div>
@endsection
