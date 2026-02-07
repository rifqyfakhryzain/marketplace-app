@php
    $rekomendasi = [
        [
            'name' => 'Laptop Lenovo ThinkPad',
            'price' => 7500000,
            'location' => 'Jakarta Selatan',
            'image' => 'images/produk.jpg',
        ],
        [
            'name' => 'iPhone 11 128GB',
            'price' => 6800000,
            'location' => 'Bandung',
            'image' => 'images/produk.jpg',
        ],
        [
            'name' => 'Kamera Canon EOS M50',
            'price' => 5200000,
            'location' => 'Surabaya',
            'image' => 'images/produk.jpg',
        ],
        [
            'name' => 'Sepeda Gunung Polygon',
            'price' => 3100000,
            'location' => 'Malang',
            'image' => 'images/produk.jpg',
        ],
        [
            'name' => 'PlayStation 4 Slim',
            'price' => 4200000,
            'location' => 'Depok',
            'image' => 'images/produk.jpg',
        ],
        [
            'name' => 'Jam Tangan Seiko',
            'price' => 1900000,
            'location' => 'Yogyakarta',
            'image' => 'images/produk.jpg',
        ],
    ];
@endphp

<div class="max-w-7xl mx-auto px-6 mt-12">

    <!-- HEADER -->
    <div class="mb-4">
        <h2 class="text-lg font-bold">Rekomendasi untuk Kamu</h2>
        <p class="text-sm text-gray-500">
            Barang pilihan berdasarkan minat pengguna
        </p>
    </div>

    <!-- GRID PRODUK -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

        @foreach ($rekomendasi as $product)
            <div
                class="bg-white rounded-xl shadow p-3
                        hover:shadow-lg transition cursor-pointer">

                <img src="{{ asset($product['image']) }}" class="w-full h-[150px] object-cover rounded-lg"
                    alt="{{ $product['name'] }}">

                <p class="text-sm mt-2 line-clamp-2">
                    {{ $product['name'] }}
                </p>

                <p class="font-bold mt-1">
                    Rp {{ number_format($product['price'], 0, ',', '.') }}
                </p>

                <span class="text-xs text-gray-500">
                    {{ $product['location'] }}
                </span>
            </div>
        @endforeach

    </div>

    <!-- BUTTON LOAD MORE -->
    <div class="text-center mt-8">
        <button
            class="px-6 py-2
                   border border-gray-300
                   rounded-full
                   text-sm font-semibold
                   hover:bg-gray-100
                   transition">
            Muat lebih banyak
        </button>
    </div>

</div>
