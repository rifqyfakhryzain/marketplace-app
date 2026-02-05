@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- LEFT SIDEBAR: NAVIGATION --}}
            <div class="lg:col-span-3">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden sticky top-6">
                    <div class="p-4 border-b border-gray-100 bg-gray-50">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold shrink-0">
                                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                            </div>
                            <div class="overflow-hidden">
                                <h2 class="font-bold text-gray-900 text-sm truncate">Menu Penjual</h2>
                                <p class="text-xs text-gray-500 truncate">Pengelola Toko</p>
                            </div>
                        </div>
                    </div>
                    
                    <nav class="p-2 space-y-1">
                        <a href="{{ route('seller.statistics') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('seller.statistics') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            Dashboard
                        </a>
                        <a href="{{ route('seller.orders') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('seller.orders') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            Pesanan
                        </a>
                        <a href="{{ route('seller.products') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('seller.products*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            Produk Saya
                        </a>
                    </nav>
                </div>
            </div>

            {{-- MAIN CONTENT: FORM EDIT --}}
            <div class="lg:col-span-9">
                
                {{-- Pastikan route update benar (biasanya butuh ID) --}}
                <form method="POST" action="{{ route('seller.products.update', $barang->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 

                    {{-- HEADER & ACTIONS --}}
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Edit Produk</h1>
                            <p class="text-sm text-gray-500">Perbarui informasi produk: <span class="font-semibold text-indigo-600">{{ $barang->nama_barang }}</span></p>
                        </div>
                    </div>

                    {{-- GLOBAL ERRORS --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan input</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        
                        {{-- LEFT COLUMN: INFO & IMAGES --}}
                        <div class="lg:col-span-2 space-y-6">
                            
                            {{-- CARD 1: INFORMASI UMUM --}}
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-100 pb-2">Informasi Dasar</h3>
                                
                                <div class="space-y-4">
                                    {{-- Nama Barang --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk <span class="text-red-500">*</span></label>
                                        <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}"
                                            placeholder="Contoh: iPhone 13 Pro Max" 
                                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition @error('nama_barang') border-red-300 @enderror">
                                        @error('nama_barang') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- Deskripsi --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi <span class="text-red-500">*</span></label>
                                        <textarea name="deskripsi" rows="8" 
                                            placeholder="Jelaskan detail produkmu..."
                                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition leading-relaxed @error('deskripsi') border-red-300 @enderror">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                                        @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- CARD 2: MEDIA / GAMBAR --}}
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-100 pb-2">Gambar Produk</h3>
                                
                                {{-- 1. GAMBAR LAMA (EXISTING) --}}
                                @if(isset($barang->gambars) && $barang->gambars->count() > 0)
                                    <div class="mb-6">
                                        <p class="text-sm text-gray-700 font-medium mb-3">Gambar Saat Ini:</p>
                                        <div class="grid grid-cols-4 sm:grid-cols-5 gap-4">
                                            @foreach ($barang->gambars as $gambar)
                                                <div class="relative group rounded-lg overflow-hidden border border-gray-200 aspect-square shadow-sm">
                                                    {{-- Gambar --}}
                                                    <img src="{{ asset('storage/' . $gambar->path) }}" class="w-full h-full object-cover">
                                                    
                                                    {{-- Overlay Hapus --}}
                                                    <label class="absolute inset-0 bg-red-600/90 opacity-0 group-hover:opacity-100 transition cursor-pointer flex flex-col items-center justify-center text-white">
                                                        <input type="checkbox" name="hapus_gambar[]" value="{{ $gambar->id }}" class="hidden peer">
                                                        {{-- Icon Tong Sampah --}}
                                                        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                        <span class="text-xs font-bold peer-checked:hidden">Hapus?</span>
                                                        <span class="hidden peer-checked:inline font-bold text-yellow-300">Dihapus</span>
                                                    </label>
                                                    
                                                    {{-- Indikator jika dicentang (perlu JS tambahan utk visual realtime, tapi ini fallback CSS) --}}
                                                    <div class="absolute top-1 right-1 pointer-events-none">
                                                        <div class="w-4 h-4 bg-white rounded-full border border-gray-300 hidden peer-checked:block"></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2 bg-yellow-50 p-2 rounded border border-yellow-100 inline-block">
                                            💡 Klik gambar untuk menandainya agar <strong>dihapus</strong> saat disimpan.
                                        </p>
                                    </div>
                                    <hr class="border-gray-100 my-4">
                                @endif

                                {{-- 2. UPLOAD GAMBAR BARU --}}
                                <div>
                                    <p class="text-sm text-gray-700 font-medium mb-2">Tambah Gambar Baru:</p>
                                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:bg-gray-50 transition relative cursor-pointer group" onclick="document.getElementById('imagesInput').click()">
                                        <input type="file" name="gambar[]" id="imagesInput" accept="image/png, image/jpeg" multiple class="hidden">
                                        
                                        <div class="space-y-2 pointer-events-none">
                                            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mx-auto group-hover:scale-110 transition">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                            </div>
                                            <p class="text-sm text-gray-600 font-medium">Klik untuk upload foto baru</p>
                                            <p class="text-xs text-gray-400">JPG/PNG (Maks 2MB)</p>
                                        </div>
                                    </div>
                                    @error('gambar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                                    {{-- Preview Container --}}
                                    <div id="previewContainer" class="grid grid-cols-5 gap-3 mt-4">
                                        {{-- JS akan mengisi ini --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- RIGHT COLUMN: SETTINGS --}}
                        <div class="lg:col-span-1 space-y-6">
                            
                            {{-- CARD 3: ORGANISASI --}}
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Pengaturan</h3>
                                
                                {{-- Status --}}
                                <div class="mb-5">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Produk</label>
                                    <select name="status" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                        <option value="tersedia" {{ old('status', $barang->status) == 'tersedia' ? 'selected' : '' }}>✅ Aktif</option>
                                        <option value="nonaktif" {{ old('status', $barang->status) == 'nonaktif' ? 'selected' : '' }}>⛔ Nonaktif (Arsip)</option>
                                    </select>
                                </div>

                                {{-- Kategori --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                                    <select name="kategori_id" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm @error('kategori_id') border-red-300 @enderror" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id }}" {{ old('kategori_id', $barang->kategori_id) == $k->id ? 'selected' : '' }}>
                                                {{ $k->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- CARD 4: HARGA & STOK --}}
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Harga & Stok</h3>

                                {{-- Harga --}}
                                <div class="mb-5">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga Satuan <span class="text-red-500">*</span></label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <span class="text-gray-500 sm:text-sm font-bold">Rp</span>
                                        </div>
                                        <input type="number" name="harga" value="{{ old('harga', $barang->harga ?? 0) }}" 
                                            class="block w-full rounded-lg border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 @error('harga') border-red-300 @enderror" required>
                                    </div>
                                    @error('harga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                {{-- Stok --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Stok Barang <span class="text-red-500">*</span></label>
                                    <div class="relative rounded-md shadow-sm">
                                        <input type="number" name="stok" value="{{ old('stok', $barang->stok) }}" min="0"
                                            class="block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 @error('stok') border-red-300 @enderror">
                                    </div>
                                    @error('stok') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- ACTION BUTTONS (DIPINDAHKAN KE SINI) --}}
                            <div class="pt-2 flex flex-col gap-3">
                                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                    Simpan Perubahan
                                </button>
                                <a href="{{ route('seller.products') }}" class="w-full flex justify-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                                    Batal
                                </a>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

{{-- SCRIPT: Image Preview --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('imagesInput');
    const container = document.getElementById('previewContainer');

    if (!input || !container) return;

    input.addEventListener('change', function (event) {
        container.innerHTML = '';
        const files = Array.from(event.target.files).slice(0, 5);

        if (files.length === 0) return;

        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const wrapper = document.createElement('div');
                wrapper.className = 'aspect-square relative rounded-lg overflow-hidden border border-gray-200 group';
                
                wrapper.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-indigo-600/80 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <span class="text-white text-xs font-bold px-2 py-1 border border-white rounded">Baru</span>
                    </div>
                `;
                container.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });
    });
});
</script>
@endsection