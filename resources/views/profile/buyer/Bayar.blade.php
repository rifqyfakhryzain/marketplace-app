@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white rounded">

        <h1 class="text-xl font-semibold mb-2 text-center">
            Pembayaran Aman (Escrow)
        </h1>

        <p class="text-sm text-gray-600 text-center mb-6">
            Dana Anda akan ditahan oleh <b>LUNO</b> sampai barang diterima.
        </p>

        {{-- ================= RINGKASAN PESANAN ================= --}}
        <div class="border rounded p-4 mb-6">
            <h2 class="font-semibold mb-2">Ringkasan Pesanan</h2>

            <div class="text-sm space-y-1">
                <p>
                    Kode Pesanan:
                    <b>ORD-{{ $order->id }}</b>
                </p>

                <p>
                    Tanggal Pesanan:
                    {{ $order->created_at->format('d M Y H:i') }}
                </p>

                <p class="mt-2 font-medium">Produk:</p>
                <p>
                    - {{ $order->barang->nama_barang ?? 'Produk' }}
                    (Qty: {{ $order->qty }})
                </p>
            </div>
        </div>

        {{-- ================= TOTAL PEMBAYARAN ================= --}}
        <div class="flex justify-between items-center mb-6">
            <span class="text-sm font-semibold">Total Pembayaran</span>
            <span class="text-lg font-bold text-blue-600">
                Rp {{ number_format($order->total_price, 0, ',', '.') }}
            </span>
        </div>

        {{-- ================= INFO ESCROW ================= --}}
        <div class="border rounded p-4 mb-6 bg-gray-50">
            <h2 class="font-semibold mb-2">Transfer ke Rekening Bersama</h2>

            <div class="text-sm space-y-1">
                <p>Bank: <b>BCA</b></p>
                <p>No Rekening: <b>1234567890</b></p>
                <p>Atas Nama: <b>PT LUNO INDONESIA</b></p>
            </div>

            <p class="text-xs text-gray-600 mt-3">
                ⚠️ Pastikan nominal transfer <b>sesuai</b>.
                Dana akan ditahan oleh LUNO dan <b>baru diteruskan ke penjual</b>
                setelah Anda mengonfirmasi barang diterima.
            </p>
        </div>

        {{-- ================= STATUS & BATAS WAKTU ================= --}}
        <div class="text-sm text-gray-700 mb-2">
            Status Escrow:
            <b class="text-orange-600">
                {{ ucfirst($escrow->status) }}
            </b>
        </div>

        <div class="text-sm text-red-600 mb-6">
            Batas waktu pembayaran:
            <b>{{ now()->addDay()->format('d M Y H:i') }}</b>
        </div>

        {{-- ================= AKSI ================= --}}
        <div class="flex flex-col items-center gap-3">

            <form action="{{ route('buyer.orders.confirmTransfer', $order->id) }}" method="POST" class="w-full max-w-xs">
                @csrf

                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded text-sm w-full hover:bg-blue-700 transition"
                    onclick="return confirm('Yakin sudah melakukan transfer?')">
                    Saya Sudah Transfer
                </button>
            </form>


            @if ($escrow->status === 'holding')
                {{-- tombol transfer --}}
            @else
                <div class="text-sm text-orange-600 font-medium">
                    Menunggu verifikasi admin
                </div>
            @endif




            <a href="{{ route('buyer.orders.detail', $order->id) }}" class="text-sm text-blue-600 underline">
                Kembali ke Detail Pesanan
            </a>
        </div>

    </div>
@endsection
