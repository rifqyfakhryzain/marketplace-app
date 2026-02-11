@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto p-6">

        <h1 class="text-2xl font-bold mb-6">
            Verifikasi Pembayaran (Escrow)
        </h1>

        @if ($escrows->isEmpty())
            <div class="bg-gray-50 border rounded p-6 text-center text-gray-500">
                Tidak ada pembayaran yang menunggu verifikasi.
            </div>
        @else
            <div class="bg-white border rounded-lg overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Order</th>
                            <th class="p-3">Buyer</th>
                            <th class="p-3">Total</th>
                            <th class="p-3">Status</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($escrows as $escrow)
                            <tr class="border-t">
                                <td class="p-3">
                                    ORD-{{ $escrow->order_id }}
                                </td>
                                <td class="p-3 text-center">
                                    {{ $escrow->order->buyer->name ?? '-' }}
                                </td>
                                <td class="p-3 text-center">
                                    Rp {{ number_format($escrow->amount, 0, ',', '.') }}
                                </td>
                                <td class="p-3 text-center">
                                    <span class="px-2 py-1 text-xs rounded bg-orange-100 text-orange-700">
                                        Menunggu Verifikasi
                                    </span>
                                </td>
                                <td class="p-3 text-center">
                                    <form method="POST" action="{{ route('admin.escrows.verify', $escrow->id) }}">
                                        @csrf
                                        <button
                                            class="px-3 py-1 text-xs rounded bg-green-600 text-white hover:bg-green-700">
                                            Verifikasi
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
@endsection
