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

            @php
            $products = [
                [
                    'id' => 1,
                    'name' => 'Kompor Listrik dan Oven',
                    'price' => 6000000,
                    'location' => 'Kota Bandung',
                    'image' => 'images/produk.jpg',
                ],
                [
                    'id' => 2,
                    'name' => 'Kamera Mirrorless Sony',
                    'price' => 4500000,
                    'location' => 'Jakarta Selatan',
                    'image' => 'images/produk.jpg',
                ],
                [
                    'id' => 3,
                    'name' => 'Sepeda Lipat Polygon',
                    'price' => 3200000,
                    'location' => 'Surabaya',
                    'image' => 'images/produk.jpg',
                ],
            ];
            @endphp



            @foreach ($products as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach



        </div>
    </div>

</div>

@include('components.rekomendasi')


@endsection
