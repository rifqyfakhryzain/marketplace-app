@isset($product)
<div class="{{ $horizontal ?? false ? 'w-[220px] shrink-0' : 'max-w-[220px] mx-auto' }}">

<a href="{{ route('products.show', $product->id) }}"
   class="block">

    <div class="bg-white rounded-xl shadow-sm p-3
                hover:shadow-lg transition duration-300 h-full">

        <img src="{{ $product->images->first()
            ? asset('storage/' . $product->images->first()->image_path)
            : asset('images/placeholder-product.jpg') }}"
            class="w-full h-[180px] object-cover rounded-lg"
            alt="{{ $product->nama_barang }}">

        <p class="text-sm mt-2 line-clamp-2 min-h-[44px]">
            {{ $product->nama_barang }}
        </p>

        <p class="font-bold mt-1 text-blue-600">
            Rp {{ number_format($product->harga, 0, ',', '.') }}
        </p>

        <span class="text-xs text-gray-500">
            {{ $product->penjual->alamat ?? 'Indonesia' }}
        </span>

    </div>
</a>

</div>
@endisset
