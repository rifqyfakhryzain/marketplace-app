@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4">

        <h1 class="text-2xl font-bold mb-6">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- ================= LEFT CONTENT ================= --}}
            <div class="lg:col-span-8 space-y-6">

                {{-- 1. RINGKASAN PRODUK --}}
                <div class="bg-white border rounded-lg p-4 flex gap-4">
                    <img
                        src="https://via.placeholder.com/120x90"
                        class="w-32 aspect-[4/3] object-cover rounded bg-gray-100"
                        alt="Produk"
                    >

                    <div class="flex-1">
                        <h2 class="font-semibold">
                            iPhone 13 Pro Max 256GB – Sierra Blue
                        </h2>
                        <p class="text-sm text-gray-500">
                            Dijual oleh <span class="font-medium">Toko Jaya</span>
                        </p>

                        <p class="mt-2 text-lg font-bold">
                            Rp 15.000.000
                        </p>
                    </div>
                </div>

                {{-- 2. ALAMAT PENGIRIMAN --}}
                <div class="bg-white border rounded-lg p-4 space-y-4">
                    <h2 class="font-semibold">Alamat Pengiriman</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input
                            type="text"
                            placeholder="Nama Penerima"
                            class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        >
                        <input
                            type="text"
                            placeholder="No. HP"
                            class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    <textarea
                        rows="3"
                        placeholder="Alamat lengkap pengiriman"
                        class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    ></textarea>

                    <textarea
                        rows="2"
                        placeholder="Catatan untuk penjual (opsional)"
                        class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    ></textarea>
                </div>

                {{-- 3. PENJELASAN ESCROW --}}
                <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
                    <h2 class="font-semibold text-blue-900 mb-2">
                        Cara Kerja Escrow
                    </h2>

                    <ol class="list-decimal list-inside text-sm text-blue-800 space-y-1">
                        <li>Pembeli membayar ke rekening perusahaan</li>
                        <li>Dana ditahan oleh admin (escrow)</li>
                        <li>Penjual mengirim barang</li>
                        <li>Pembeli konfirmasi barang diterima</li>
                        <li>Dana dicairkan ke penjual</li>
                    </ol>

                    <p class="text-xs text-blue-700 mt-2">
                        Jika barang tidak sesuai, pembeli dapat mengajukan komplain sebelum dana dicairkan.
                    </p>
                </div>

            </div>

            {{-- ================= RIGHT SIDEBAR ================= --}}
            <div class="lg:col-span-4">

                <div class="bg-white border rounded-lg p-4 space-y-4 sticky top-6">

                    <h2 class="font-semibold">Ringkasan Pembayaran</h2>

                    <div class="flex justify-between text-sm">
                        <span>Harga Barang</span>
                        <span>Rp 15.000.000</span>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span>Ongkir</span>
                        <span>Rp 25.000</span>
                    </div>

                    <hr>

                    <div class="flex justify-between font-bold">
                        <span>Total</span>
                        <span>Rp 15.025.000</span>
                    </div>

                    <div class="text-xs text-gray-500">
                        Status dana:
                        <span class="font-medium text-orange-600">
                            Akan ditahan oleh Admin (Escrow)
                        </span>
                    </div>

                    {{-- TOMBOL BAYAR --}}
                    <a
                        href="{{ route('buyer.orders.pay', $product ?? 1) }}"
                        class="block text-center w-full bg-blue-600 text-white py-3 rounded font-semibold
                            hover:bg-blue-700 transition"
                    >
                        Bayar Sekarang
                    </a>


                    <p class="text-xs text-gray-500 text-center">
                        Dengan melanjutkan, kamu setuju menggunakan sistem escrow.
                    </p>

                </div>

            </div>

        </div>

    </div>
</div>
@endsection
