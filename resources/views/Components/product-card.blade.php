@isset($product)
    <a href="{{ route('products.show', $product->id) }}" class="block w-[200px] shrink-0">

        <div class="bg-white rounded-xl shadow p-3
                hover:shadow-lg transition">

            <img src="{{ $product->images->first()
                ? asset('storage/' . $product->images->first()->image_path)
                : asset('images/placeholder-product.jpg') }}"
                class="w-full h-[140px] object-cover rounded-lg" alt="{{ $product->nama_barang }}">


            <p class="text-sm mt-2 line-clamp-2">
                {{ $product->nama_barang }}
            </p>

            <p class="font-bold mt-1">
                Rp {{ number_format($product->harga, 0, ',', '.') }}
            </p>

            <span class="text-xs text-gray-500">
                {{ $product->penjual->alamat ?? 'Indonesia' }}
            </span>

        </div>
    </a>
@endisset
