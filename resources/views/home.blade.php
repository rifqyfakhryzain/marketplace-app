@extends('layouts.app')

@section('content')
    @include('components.ads-slider')

    <div class="mb-16">
        @include('components.categories')
    </div>

    <div class="max-w-7xl mx-auto px-6 mt-12">

        <div class="flex items-center justify-between mb-3">
            <h2 class="text-lg font-bold">Baru Diunggah</h2>
            <a href="#" class="text-sm text-blue-600">Lihat semua</a>
        </div>

        <div class="overflow-x-auto">
            <div class="flex gap-4 pb-2">

                @foreach ($products as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            </div>
        </div>

    </div>

    @include('components.rekomendasi')
@endsection
