@extends('layouts.admin')


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
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded shadow">
                <p class="text-sm text-gray-500">Dana Tertahan</p>
                <p class="text-xl font-bold text-yellow-600">
                    Rp {{ number_format($totalEscrowPending, 0, ',', '.') }}
                </p>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <p class="text-sm text-gray-500">Escrow Holding</p>
                <p class="text-xl font-bold">
                    Rp {{ number_format($escrowHolding, 0, ',', '.') }}
                </p>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <p class="text-sm text-gray-500">Escrow Siap Cair</p>
                <p class="text-xl font-bold text-blue-600">
                    Rp {{ number_format($escrowReady, 0, ',', '.') }}
                </p>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <p class="text-sm text-gray-500">Dana Dicairkan</p>
                <p class="text-xl font-bold text-green-600">
                    Rp {{ number_format($totalReleased, 0, ',', '.') }}
                </p>
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
                        <th class="p-3 text-left">Order</th>
                        <th class="p-3">Pembeli</th>
                        <th class="p-3">Penjual</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Status Order</th>
                        <th class="p-3">Status Dana</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        // STATUS ORDER (ORDER)
                        $orderStatusMap = [
                            'pending' => [
                                'text' => 'Menunggu Pembayaran',
                                'class' => 'bg-yellow-100 text-yellow-800',
                            ],
                            'waiting_verification' => [
                                'text' => 'Menunggu Verifikasi',
                                'class' => 'bg-orange-100 text-orange-800',
                            ],
                            'processed' => [
                                'text' => 'Diproses Penjual',
                                'class' => 'bg-blue-100 text-blue-800',
                            ],
                            'shipped' => [
                                'text' => 'Sedang Dikirim',
                                'class' => 'bg-purple-100 text-purple-800',
                            ],
                            'completed' => [
                                'text' => 'Selesai',
                                'class' => 'bg-green-100 text-green-800',
                            ],
                        ];

                        // STATUS DANA (ESCROW)
                        $escrowStatusMap = [
                            'waiting_verification' => [
                                'text' => 'Menunggu Verifikasi',
                                'class' => 'bg-orange-100 text-orange-700',
                            ],
                            'holding' => [
                                'text' => 'Dana Ditahan',
                                'class' => 'bg-yellow-100 text-yellow-700',
                            ],
                            'ready' => [
                                'text' => 'Siap Dicairkan',
                                'class' => 'bg-blue-100 text-blue-700',
                            ],
                            'released' => [
                                'text' => 'Dana Dicairkan',
                                'class' => 'bg-green-100 text-green-700',
                            ],
                        ];
                    @endphp

                    @forelse ($escrows as $escrow)
                        <tr class="border-t">
                            {{-- ORDER --}}
                            <td class="p-3">
                                ORD-{{ $escrow->order->id }}
                            </td>

                            {{-- BUYER --}}
                            <td class="p-3 text-center">
                                {{ $escrow->order->buyer->name ?? '-' }}
                            </td>

                            {{-- SELLER --}}
                            <td class="p-3 text-center">
                                {{ $escrow->order->barang->penjual->name ?? '-' }}
                            </td>

                            {{-- TOTAL --}}
                            <td class="p-3 text-center">
                                Rp {{ number_format($escrow->amount, 0, ',', '.') }}
                            </td>

                            {{-- STATUS ORDER --}}
                            @php
                                $orderStatus = $orderStatusMap[$escrow->order->status] ?? [
                                    'text' => strtoupper($escrow->order->status),
                                    'class' => 'bg-gray-100 text-gray-700',
                                ];
                            @endphp

                            <td class="p-3 text-center">
                                <span class="px-2 py-1 text-xs rounded {{ $orderStatus['class'] }}">
                                    {{ $orderStatus['text'] }}
                                </span>
                            </td>


                            {{-- STATUS DANA --}}
                            @php
                                $escrowStatus = $escrowStatusMap[$escrow->status] ?? [
                                    'text' => strtoupper($escrow->status),
                                    'class' => 'bg-gray-100 text-gray-700',
                                ];
                            @endphp

                            <td class="p-3 text-center">
                                <span class="px-2 py-1 text-xs rounded {{ $escrowStatus['class'] }}">
                                    {{ $escrowStatus['text'] }}
                                </span>
                            </td>


                            {{-- AKSI ADMIN --}}
                            <td class="p-3 text-center space-y-1">

                                {{-- VERIFIKASI PEMBAYARAN --}}
                                @if ($escrow->status === 'waiting_verification')
                                    <form method="POST" action="{{ route('admin.escrows.verify', $escrow->id) }}">
                                        @csrf
                                        <button onclick="return confirm('Verifikasi pembayaran ini?')"
                                            class="px-3 py-1 text-xs rounded bg-blue-600 text-white hover:bg-blue-700">
                                            Verifikasi
                                        </button>
                                    </form>
                                @endif

                                {{-- CAIRKAN DANA --}}
                                @if ($escrow->status === 'ready')
                                    <form method="POST" action="{{ route('admin.escrows.release', $escrow) }}">
                                        @csrf
                                        <button onclick="return confirm('Yakin cairkan dana ke seller?')"
                                            class="px-3 py-1 text-xs rounded bg-green-600 text-white hover:bg-green-700">
                                            Cairkan Dana
                                        </button>
                                    </form>
                                @endif

                                {{-- TIDAK ADA AKSI --}}
                                @if (!in_array($escrow->status, ['waiting_verification', 'ready']))
                                    <span class="text-xs text-gray-400">—</span>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-6 text-center text-gray-500">
                                Tidak ada data escrow
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
