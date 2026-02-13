<div class="max-w-7xl mx-auto px-6 mt-12">

    <div class="mb-4">
        <h2 class="text-lg font-bold">Rekomendasi untuk Kamu</h2>
        <p class="text-sm text-gray-500">
            Barang pilihan berdasarkan aktivitas pengguna
        </p>
    </div>

<div class="flex flex-wrap gap-4 items-start">

        @forelse ($products as $barang)
            @include('components.product-card', [
                'product' => $barang,
                'horizontal' => false
            ])
        @empty
            <p class="text-gray-500 w-full">
                Belum ada rekomendasi produk.
            </p>
        @endforelse

    </div>

</div>
