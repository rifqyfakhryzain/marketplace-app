@isset($product)
<a href="{{ route('products.show', $product['id']) }}"
   class="block w-[200px] shrink-0">

    <div class="bg-white rounded-xl shadow p-3
                hover:shadow-lg transition">

        <img
            src="{{ asset($product['image']) }}"
            class="w-full h-[140px] object-cover rounded-lg"
            alt="{{ $product['name'] }}"
        >

        <p class="text-sm mt-2">
            {{ $product['name'] }}
        </p>

        <p class="font-bold mt-1">
            Rp {{ number_format($product['price'], 0, ',', '.') }}
        </p>

        <span class="text-xs text-gray-500">
            {{ $product['location'] }}
        </span>

    </div>
</a>
@endisset
