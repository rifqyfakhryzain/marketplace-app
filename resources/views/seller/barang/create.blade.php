@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6">

        <div class="grid grid-cols-12 gap-6">

            {{-- KIRI --}}
            <div class="col-span-3">
                <div class="space-y-6 text-sm">

                    <div>
                        <p class="font-semibold">Pesanan</p>
                        <div class="ml-3 mt-2">
                            <a href="{{ route('seller.orders') }}"
                                class="block {{ request()->routeIs('seller.orders') ? 'font-bold text-black' : 'text-gray-600' }}">
                                Daftar Pesanan
                            </a>
                        </div>
                    </div>

                    <div>
                        <p class="font-semibold">Produk</p>
                        <div class="ml-3 mt-2 space-y-1">
                            <a href="{{ route('seller.products') }}"
                                class="block {{ request()->routeIs('seller.products') ? 'font-bold text-black' : 'text-gray-600' }}">
                                Produk Saya
                            </a>

                            <a href="{{ route('seller.products.create') }}"
                                class="block {{ request()->routeIs('seller.products.create') ? 'font-bold text-black' : 'text-gray-600' }}">
                                Tambahkan Produk Baru
                            </a>
                        </div>
                    </div>

                    <div>
                        <p class="font-semibold">Statistik</p>
                        <div class="ml-3 mt-2">
                            <a href="{{ route('seller.statistics') }}"
                                class="block {{ request()->routeIs('seller.statistics') ? 'font-bold text-black' : 'text-gray-600' }}">
                                Statistik Penjualan
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- KANAN --}}
            <div class="col-span-9 bg-white rounded p-6">

                <h1 class="text-xl font-semibold mb-6">
                    Tambahkan Produk Baru
                </h1>

                {{-- ERROR VALIDASI --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc ml-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

<form method="POST"
      action="{{ route('seller.products.store') }}"
      enctype="multipart/form-data"
      class="space-y-6">                    @csrf

                    {{-- Nama Produk --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Nama Produk
                        </label>
                        <input type="text" name="nama_barang" value="{{ old('nama_barang') }}"
                            placeholder="Contoh: iPhone 11 64GB" class="w-full border rounded px-3 py-2 focus:outline-none"
                            required>
                    </div>

                    {{-- Harga & Stok --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Harga
                            </label>
                            <input type="number" name="harga" value="{{ old('harga') }}" placeholder="4500000"
                                class="w-full border rounded px-3 py-2 focus:outline-none" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Stok
                            </label>
                            <input type="number" name="stok" value="{{ old('stok', 0) }}" placeholder="0"
                                class="w-full border rounded px-3 py-2 focus:outline-none" required>
                        </div>
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Kategori
                        </label>
                        <select name="kategori_id" class="w-full border rounded px-3 py-2" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Deskripsi Produk
                        </label>
                        <textarea name="deskripsi" rows="5" placeholder="Jelaskan kondisi produk, kelengkapan, minus, dll."
                            class="w-full border rounded px-3 py-2 focus:outline-none" required>{{ old('deskripsi') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">
                            Tulis deskripsi yang jelas agar pembeli percaya.
                        </p>
                    </div>

{{-- GAMBAR PRODUK --}}
{{-- GAMBAR PRODUK --}}
<div>
    <label class="block text-sm font-medium mb-1">
        Gambar Produk
    </label>

    <div class="border-2 border-dashed rounded-lg p-4">
        <input
            type="file"
            name="images[]"
            id="imagesInput"
            accept="image/png, image/jpeg"
            multiple
            class="hidden"
        >

        <label for="imagesInput"
               class="cursor-pointer flex flex-col items-center gap-2 text-center">

<div id="previewContainer" class="grid grid-cols-5 gap-2">
    @for ($i = 0; $i < 5; $i++)
        <div class="w-20 h-20 bg-gray-100 rounded flex items-center justify-center text-gray-400">
            +
        </div>
    @endfor
            </div>

            <span class="text-sm text-gray-600 mt-2">
                Klik untuk upload beberapa gambar
            </span>
            <span class="text-xs text-gray-400">
                Maks 5 gambar • JPG / PNG
            </span>
        </label>
    </div>

    @error('images')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror

    @error('images.*')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>




                    {{-- STATUS --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Status Produk
                        </label>
                        <select name="status" class="w-full border rounded px-3 py-2">
                            <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>
                                Aktif (langsung dijual)
                            </option>
                            <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>
                                Nonaktif (simpan dulu)
                            </option>
                        </select>
                    </div>

                    {{-- TOMBOL --}}
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('seller.products') }}" class="px-4 py-2 border rounded">
                            Batal
                        </a>

                        <button type="submit" class="px-4 py-2 bg-black text-white rounded">
                            Simpan Produk
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection


<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('imagesInput');
    const container = document.getElementById('previewContainer');
    let filesArr = [];

    input.addEventListener('change', function (e) {
        const newFiles = Array.from(e.target.files);

        // Gabungkan file lama + baru
        filesArr = filesArr.concat(newFiles);

        // Maksimal 5
        if (filesArr.length > 5) {
            alert('Maksimal 5 gambar');
            filesArr = filesArr.slice(0, 5);
        }

        // Update input file
        const dataTransfer = new DataTransfer();
        filesArr.forEach(file => dataTransfer.items.add(file));
        input.files = dataTransfer.files;

        // Preview
        container.innerHTML = '';
        filesArr.forEach(file => {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-20 h-20 object-cover rounded';
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        });

        // Sisa slot +
        for (let i = filesArr.length; i < 5; i++) {
            const div = document.createElement('div');
            div.className = 'w-20 h-20 bg-gray-100 rounded flex items-center justify-center text-gray-400';
            div.innerText = '+';
            container.appendChild(div);
        }
    });
});
</script>



