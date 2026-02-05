@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- LEFT SIDEBAR: NAVIGATION --}}
            <div class="lg:col-span-3">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden sticky top-6">
                    {{-- User Short Profile --}}
                    <div class="p-4 border-b border-gray-100 bg-gray-50">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold shrink-0">
                                {{ strtoupper(substr(auth()->user()->name ?? 'S', 0, 1)) }}
                            </div>
                            <div class="overflow-hidden">
                                <h2 class="font-bold text-gray-900 text-sm truncate">Menu Penjual</h2>
                                <p class="text-xs text-gray-500 truncate">Pengelola Toko</p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Menu Links --}}
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

            {{-- MAIN CONTENT --}}
            <div class="lg:col-span-9">
                
                <form method="POST" action="{{ route('seller.products.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- HEADER & ACTIONS --}}
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Tambah Produk Baru</h1>
                            <p class="text-sm text-gray-500">Lengkapi detail produk Anda di bawah ini.</p>
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
                                    <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada form</h3>
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

                        {{-- COLUMN 1: MAIN INFO (Width 2/3) --}}
                        <div class="lg:col-span-2 space-y-6">
                            
                            {{-- Card: Informasi Dasar --}}
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-100 pb-2">Informasi Produk</h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk <span class="text-red-500">*</span></label>
                                        <input type="text" name="nama_barang" value="{{ old('nama_barang') }}"
                                            placeholder="Contoh: iPhone 11 64GB Resmi iBox" 
                                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition @error('nama_barang') border-red-300 @enderror"
                                            required>
                                        @error('nama_barang') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi <span class="text-red-500">*</span></label>
                                        <textarea name="deskripsi" rows="6" 
                                            placeholder="Jelaskan spesifikasi, kondisi, dan keunggulan produk Anda..."
                                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition leading-relaxed @error('deskripsi') border-red-300 @enderror"
                                            required>{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Card: Media / Gambar --}}
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-100 pb-2">Foto Produk</h3>
                                
                                <div class="space-y-4">
                                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:bg-gray-50 transition relative cursor-pointer group bg-gray-50" onclick="document.getElementById('imagesInput').click()">
                                        <input type="file" name="images[]" id="imagesInput" accept="image/png, image/jpeg, image/jpg" multiple class="hidden">
                                        
                                        <div class="space-y-2 pointer-events-none">
                                            <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto group-hover:scale-110 transition">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                            <p class="text-sm text-gray-600 font-medium">Klik untuk upload foto</p>
                                            <p class="text-xs text-gray-400">PNG, JPG (Maks. 5 Foto)</p>
                                        </div>
                                    </div>
                                    @error('images') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror

                                    {{-- Preview Area --}}
                                    <div id="previewContainer" class="grid grid-cols-5 gap-3">
                                        {{-- Placeholder kotak kosong akan digenerate via JS --}}
                                        @for ($i = 0; $i < 5; $i++)
                                            <div class="aspect-square bg-gray-100 rounded-lg flex items-center justify-center border border-gray-200">
                                                <span class="text-gray-300 text-2xl">+</span>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- COLUMN 2: SETTINGS (Width 1/3) --}}
                        <div class="lg:col-span-1 space-y-6">
                            
                            {{-- Card: Organisasi --}}
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Pengaturan</h3>
                                
                                <div class="space-y-4">
                                    {{-- Status --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Produk</label>
                                        <select name="status" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                            <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>✅ Aktif (Tersedia)</option>
                                            <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>⛔ Arsip (Tidak Tampil)</option>
                                        </select>
                                    </div>

                                    {{-- Kategori --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                                        <select name="kategori_id" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm @error('kategori_id') border-red-300 @enderror" required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($kategori ?? [] as $k)
                                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                                    {{ $k->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Card: Harga & Stok --}}
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Harga & Stok</h3>
                                
                                <div class="space-y-4">
                                    {{-- Harga --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Harga Satuan <span class="text-red-500">*</span></label>
                                        <div class="relative rounded-md shadow-sm">
                                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                <span class="text-gray-500 sm:text-sm font-bold">Rp</span>
                                            </div>
                                            <input type="number" name="harga" value="{{ old('harga') }}" placeholder="0" 
                                                class="block w-full rounded-lg border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 @error('harga') border-red-300 @enderror" required>
                                        </div>
                                        @error('harga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- Stok --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Stok Barang <span class="text-red-500">*</span></label>
                                        <div class="relative rounded-md shadow-sm">
                                            <input type="number" name="stok" value="{{ old('stok') }}" placeholder="0" 
                                                class="block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 @error('stok') border-red-300 @enderror" required>
                                        </div>
                                        @error('stok') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- ACTION BUTTONS (BARU) --}}
                            <div class="pt-2 flex flex-col gap-3">
                                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition">
                                    Simpan Produk
                                </button>
                                <a href="{{ route('seller.products') }}" class="w-full flex justify-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                                    Batal
                                </a>
                            </div>

                        </div> {{-- End Right Column --}}

                    </div> {{-- End Grid --}}
                </form>

            </div> {{-- End Main Content --}}
        </div>
    </div>
</div>

{{-- SCRIPT: Image Preview --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('imagesInput');
    const container = document.getElementById('previewContainer');
    const maxSlots = 5;

    if (!input || !container) return;

    input.addEventListener('change', function (event) {
        // Reset container content
        container.innerHTML = '';

        // Ambil file (maksimal 5)
        const files = Array.from(event.target.files).slice(0, maxSlots);

        // Loop file yang dipilih
        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = function (e) {
                // Buat elemen div wrapper
                const wrapper = document.createElement('div');
                wrapper.className = 'aspect-square relative rounded-lg overflow-hidden border border-gray-200 shadow-sm';

                // Buat elemen img
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover';
                
                wrapper.appendChild(img);
                container.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });

        // Isi sisa slot kosong dengan placeholder
        const emptySlots = maxSlots - files.length;
        for (let i = 0; i < emptySlots; i++) {
            const div = document.createElement('div');
            div.className = 'aspect-square bg-gray-50 rounded-lg flex items-center justify-center border border-dashed border-gray-300';
            div.innerHTML = '<span class="text-gray-300 text-2xl">+</span>';
            container.appendChild(div);
        }
    });
});
</script>
@endsection