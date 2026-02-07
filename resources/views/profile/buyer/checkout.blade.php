@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4">

        <h1 class="text-2xl font-bold mb-6">Checkout</h1>

        {{-- FORM UTAMA --}}
        <form
            method="POST"
            action="{{ route('buyer.checkout.store', $barang->id) }}"
        >
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                {{-- ================= LEFT CONTENT ================= --}}
                <div class="lg:col-span-8 space-y-6">

                    {{-- 1. RINGKASAN PRODUK --}}
                    <div class="bg-white border rounded-lg p-4 flex gap-4">
<img
    src="{{ $images[0] ?? asset('images/no-image.png') }}"
    class="w-32 aspect-[4/3] object-cover rounded bg-gray-100"
    alt="{{ $barang->nama_barang }}"
>


                        <div class="flex-1">
                            <h2 class="font-semibold">
                                {{ $barang->nama_barang }}
                            </h2>

                            <p class="text-sm text-gray-500">
                                Dijual oleh
                                <span class="font-medium">
{{ $barang->penjual->name }}
                                </span>
                            </p>

                            <p class="mt-2 text-lg font-bold">
                                Rp {{ number_format($barang->harga , 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    {{-- 2. ALAMAT PENGIRIMAN --}}
                    <div class="bg-white border rounded-lg p-4 space-y-4">
                        <h2 class="font-semibold">Alamat Pengiriman</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input
                                type="text"
                                name="receiver_name"
                                placeholder="Nama Penerima"
                                required
                                class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            >

                            <input
                                type="text"
                                name="phone"
                                placeholder="No. HP"
                                required
                                class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            >
                        </div>

                        <textarea
                            name="address"
                            rows="3"
                            placeholder="Alamat lengkap pengiriman"
                            required
                            class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        ></textarea>

                        <textarea
                            name="note"
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
                        {{-- RINGKASAN PEMBAYARAN --}}
<div class="bg-white border rounded-lg p-4 space-y-4 sticky top-6">

    <h2 class="font-semibold">Ringkasan Pembayaran</h2>

    <div class="flex justify-between text-sm">
        <span>Harga Barang</span>
        <span>
            Rp {{ number_format($barang->harga, 0, ',', '.') }}
        </span>
    </div>

    <div class="flex justify-between text-sm">
        <span>Ongkir</span>
        <span>
            Rp {{ number_format($ongkir, 0, ',', '.') }}
        </span>
    </div>

    <hr>

    <div class="flex justify-between font-bold text-lg">
        <span>Total</span>
        <span>
            Rp {{ number_format($total, 0, ',', '.') }}
        </span>
    </div>

    <div class="text-xs text-gray-500">
        Status dana:
        <span class="font-medium text-orange-600">
            Akan ditahan oleh Admin (Escrow)
        </span>
    </div>

    <button
        type="submit"
        class="w-full bg-blue-600 text-white py-3 rounded font-semibold
               hover:bg-blue-700 transition"
    >
        Bayar Sekarang
    </button>

    <p class="text-xs text-gray-500 text-center">
        Dengan melanjutkan, kamu setuju menggunakan sistem escrow.
    </p>

</div>

                        <p class="text-xs text-gray-500 text-center">
                            Dengan melanjutkan, kamu setuju menggunakan sistem escrow.
                        </p>

                    </div>
                </div>

            </div>
        </form>

    </div>
</div>
@endsection
