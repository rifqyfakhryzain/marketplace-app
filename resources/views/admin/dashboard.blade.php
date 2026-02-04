@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-8">

    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl font-bold">Admin Dashboard</h1>
        <p class="text-sm text-gray-600">
            Kontrol escrow, status pesanan, dan pencairan dana
        </p>
    </div>

    {{-- RINGKASAN --}}
    <div class="grid grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Total Dana Ditahan</p>
            <p class="text-xl font-bold">Rp 12.500.000</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Menunggu Verifikasi</p>
            <p class="text-xl font-bold">3</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Dalam Pengiriman</p>
            <p class="text-xl font-bold">5</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Dispute / Return</p>
            <p class="text-xl font-bold text-red-600">1</p>
        </div>
    </div>

    {{-- TABEL TRANSAKSI --}}
    <div class="bg-white rounded shadow">
        <div class="p-4 border-b font-semibold">
            Daftar Transaksi Escrow
        </div>

        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Order ID</th>
                    <th class="p-3">Pembeli</th>
                    <th class="p-3">Penjual</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Status Order</th>
                    <th class="p-3">Status Dana</th>
                    <th class="p-3">Aksi Admin</th>
                </tr>
            </thead>

            <tbody>

                {{-- 1. MENUNGGU VERIFIKASI --}}
                <tr class="border-t">
                    <td class="p-3">ORD-001</td>
                    <td class="p-3 text-center">Budi</td>
                    <td class="p-3 text-center">Toko Jaya</td>
                    <td class="p-3 text-center">Rp 150.000</td>
                    <td class="p-3 text-center">
                        <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">
                            Menunggu Verifikasi
                        </span>
                    </td>
                    <td class="p-3 text-center">
                        <span class="px-2 py-1 text-xs rounded bg-gray-200">
                            Dana Masuk (Unverified)
                        </span>
                    </td>
                    <td class="p-3 text-center">
                        <button class="px-3 py-1 text-xs rounded bg-green-600 text-white hover:bg-green-700">
                            Verifikasi Pembayaran
                        </button>
                    </td>
                </tr>

                {{-- 2. SIAP DIPROSES --}}
                <tr class="border-t">
                    <td class="p-3">ORD-002</td>
                    <td class="p-3 text-center">Sari</td>
                    <td class="p-3 text-center">Toko Makmur</td>
                    <td class="p-3 text-center">Rp 320.000</td>
                    <td class="p-3 text-center">
                        <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700">
                            Siap Diproses
                        </span>
                    </td>
                    <td class="p-3 text-center">
                        <span class="px-2 py-1 text-xs rounded bg-orange-100 text-orange-700">
                            Dana Ditahan
                        </span>
                    </td>
                    <td class="p-3 text-center">
                        <button class="px-3 py-1 text-xs rounded bg-blue-600 text-white hover:bg-blue-700">
                            Beritahu Penjual
                        </button>
                    </td>
                </tr>

                {{-- 3. DALAM PENGIRIMAN --}}
                <tr class="border-t">
                    <td class="p-3">ORD-003</td>
                    <td class="p-3 text-center">Andi</td>
                    <td class="p-3 text-center">Toko Sentosa</td>
                    <td class="p-3 text-center">Rp 500.000</td>
                    <td class="p-3 text-center">
                        <span class="px-2 py-1 text-xs rounded bg-indigo-100 text-indigo-700">
                            Dalam Pengiriman
                        </span>
                    </td>
                    <td class="p-3 text-center">
                        <span class="px-2 py-1 text-xs rounded bg-orange-100 text-orange-700">
                            Dana Ditahan
                        </span>
                    </td>
                    <td class="p-3 text-center text-gray-400 text-xs">
                        Menunggu Konfirmasi Pembeli
                    </td>
                </tr>

                {{-- 4. DISPUTE --}}
                <tr class="border-t">
                    <td class="p-3">ORD-004</td>
                    <td class="p-3 text-center">Rina</td>
                    <td class="p-3 text-center">Toko Abadi</td>
                    <td class="p-3 text-center">Rp 275.000</td>
                    <td class="p-3 text-center">
                        <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">
                            Dispute / Return
                        </span>
                    </td>
                    <td class="p-3 text-center">
                        <span class="px-2 py-1 text-xs rounded bg-orange-100 text-orange-700">
                            Dana Ditahan
                        </span>
                    </td>
                    <td class="p-3 text-center space-x-1">
                        <button class="px-3 py-1 text-xs rounded bg-red-600 text-white hover:bg-red-700">
                            Refund
                        </button>
                        <button class="px-3 py-1 text-xs rounded bg-green-600 text-white hover:bg-green-700">
                            Cairkan
                        </button>
                    </td>
                </tr>

                {{-- 5. SELESAI --}}
                <tr class="border-t">
                    <td class="p-3">ORD-005</td>
                    <td class="p-3 text-center">Dewi</td>
                    <td class="p-3 text-center">Toko Berkah</td>
                    <td class="p-3 text-center">Rp 190.000</td>
                    <td class="p-3 text-center">
                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                            Selesai
                        </span>
                    </td>
                    <td class="p-3 text-center">
                        <span class="px-2 py-1 text-xs rounded bg-green-200 text-green-800">
                            Dana Dicairkan
                        </span>
                    </td>
                    <td class="p-3 text-center text-gray-400 text-xs">
                        —
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</div>
@endsection
