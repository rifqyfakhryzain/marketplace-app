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
                                class="block
   {{ request()->routeIs('seller.products*') ? 'font-bold text-black' : 'text-gray-600' }}">
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
                    Edit Produk
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
      action="{{ route('seller.products.update', $barang->id) }}"
      enctype="multipart/form-data"
      class="space-y-6">
    @csrf
    @method('PUT')


                    {{-- Nama Produk --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Nama Produk
                        </label>
                        <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}"
                            class="w-full border rounded px-3 py-2 focus:outline-none" required>
                    </div>

                    {{-- Harga & Stok --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Harga
                            </label>
                            <input type="number" name="harga" value="{{ old('harga', $barang->harga) }}"
                                class="w-full border rounded px-3 py-2 focus:outline-none" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Stok
                            </label>
                            <input type="number" name="stok" value="{{ old('stok', $barang->stok) }}"
                                class="w-full border rounded px-3 py-2 focus:outline-none" required>
                        </div>
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Kategori
                        </label>
                        <select name="kategori_id" class="w-full border rounded px-3 py-2" required>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}"
                                    {{ $barang->kategori_id == $k->id ? 'selected' : '' }}>
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
                        <textarea name="deskripsi" rows="5" class="w-full border rounded px-3 py-2 focus:outline-none" required>{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                    </div>

                    {{-- GAMBAR PRODUK --}}
<div>
    <label class="block text-sm font-medium mb-1">
        Gambar Produk
    </label>

    {{-- GAMBAR LAMA --}}
{{-- GAMBAR LAMA --}}
<div class="flex flex-wrap gap-3 mb-3">
    @forelse ($barang->images as $image)
        <div class="relative group w-24 h-24">
            <img
                src="{{ asset('storage/' . $image->image_path) }}"
                class="w-24 h-24 object-cover rounded border"
            >

            {{-- TOMBOL HAPUS --}}
            <button
                type="button"
                onclick="deleteImage({{ $image->id }})"
                class="absolute top-1 right-1 opacity-0 group-hover:opacity-100
                       bg-red-600 text-white text-xs px-1 rounded transition"
            >
                ✕
            </button>

            {{-- LABEL LAMA --}}
            <span class="absolute bottom-1 left-1 bg-black/60 text-white text-xs px-1 rounded">
                Lama
            </span>
        </div>
    @empty
        <p class="text-sm text-gray-400">
            Belum ada gambar
        </p>
    @endforelse

    <div id="newImagesPreview" class="flex flex-wrap gap-3 mb-3"></div>

</div>


    {{-- UPLOAD GAMBAR BARU --}}
    <div class="border-2 border-dashed rounded-lg p-4">
        <input
   type="file"
    name="images[]"
    id="imagesInput"
    accept="image/png,image/jpeg"
    multiple
    class="hidden"
        >

<label for="imagesInput"
               class="cursor-pointer flex flex-col items-center gap-2 text-center">
            <div class="grid grid-cols-4 gap-2">
                <div class="w-20 h-20 bg-gray-100 rounded flex items-center justify-center text-gray-400">
                    +
                </div>
                <div class="w-20 h-20 bg-gray-100 rounded"></div>
                <div class="w-20 h-20 bg-gray-100 rounded"></div>
                <div class="w-20 h-20 bg-gray-100 rounded"></div>
            </div>

            <span class="text-sm text-gray-600 mt-2">
                Tambah / ganti gambar produk
            </span>
            <span class="text-xs text-gray-400">
                Bisa pilih banyak gambar sekaligus
            </span>
        </label>
    </div>

    <p class="text-xs text-gray-500 mt-1">
        Kosongkan jika tidak ingin mengganti gambar
    </p>
</div>


                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Status Produk
                        </label>
                        <select name="status" class="w-full border rounded px-3 py-2">
                            <option value="tersedia" {{ $barang->status === 'tersedia' ? 'selected' : '' }}>
                                Aktif (langsung dijual)
                            </option>
                            <option value="nonaktif" {{ $barang->status === 'nonaktif' ? 'selected' : '' }}>
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
                            Update Produk
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ===== DELETE GAMBAR LAMA =====
    window.deleteImage = function(id) {
        if (!confirm('Hapus gambar ini?')) return;

        fetch(`{{ url('/seller/products/image') }}/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => {
            if (!res.ok) throw new Error('Gagal hapus');
            return res.json();
        })
        .then(() => location.reload())
        .catch(err => {
            alert('Gagal menghapus gambar');
            console.error(err);
        });
    }

    // ===== PREVIEW GAMBAR BARU =====
    const input = document.getElementById('imagesInput');
    const preview = document.getElementById('newImagesPreview');

    if (!input || !preview) return;

    input.addEventListener('change', function () {
        preview.innerHTML = '';

        Array.from(this.files).forEach(file => {
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();

            reader.onload = function (e) {
                const div = document.createElement('div');
                div.className = 'relative w-24 h-24';

                div.innerHTML = `
                    <img src="${e.target.result}"
                         class="w-24 h-24 object-cover rounded border">
                    <span class="absolute bottom-1 left-1 bg-blue-600 text-white text-xs px-1 rounded">
                        Baru
                    </span>
                `;

                preview.appendChild(div);
            };

            reader.readAsDataURL(file);
        });
    });

});
</script>


