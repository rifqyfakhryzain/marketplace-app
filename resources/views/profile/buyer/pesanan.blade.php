@extends('layouts.app')

@section('content')
    @php
        $activeStatus = request('status');

        function navClass($active, $current)
        {
            return $active === $current
                ? 'border-blue-600 text-blue-600 font-semibold'
                : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300';
        }

        function statusBadge($status)
        {
            return match ($status) {
                'pending' => ['Menunggu Pembayaran', 'bg-yellow-100 text-yellow-800 border-yellow-200'],
                'waiting_verification' => ['Menunggu Verifikasi', 'bg-orange-100 text-orange-800 border-orange-200'],
                'processed' => ['Diproses Penjual', 'bg-blue-100 text-blue-800 border-blue-200'],
                'shipped' => ['Sedang Dikirim', 'bg-purple-100 text-purple-800 border-purple-200'],
                'completed' => ['Selesai', 'bg-green-100 text-green-800 border-green-200'],
                default => ['Unknown', 'bg-gray-100 text-gray-800 border-gray-200'],
            };
        }
    @endphp

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- HEADER --}}
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Transaksi</h1>
        </div>

        {{-- NAV STATUS --}}
        <div class="border-b border-gray-200 mb-6 overflow-x-auto">
            <nav class="-mb-px flex space-x-8 min-w-max">
                <a href="{{ route('buyer.orders') }}"
                    class="py-4 px-1 border-b-2 text-sm {{ navClass($activeStatus, null) }}">
                    Semua Pesanan
                </a>

                <a href="{{ route('buyer.orders', ['status' => 'pending']) }}"
                    class="py-4 px-1 border-b-2 text-sm {{ navClass($activeStatus, 'pending') }}">
                    Belum Bayar
                </a>

                <a href="{{ route('buyer.orders', ['status' => 'processed']) }}"
                    class="py-4 px-1 border-b-2 text-sm {{ navClass($activeStatus, 'processed') }}">
                    Diproses
                </a>

                <a href="{{ route('buyer.orders', ['status' => 'shipped']) }}"
                    class="py-4 px-1 border-b-2 text-sm {{ navClass($activeStatus, 'shipped') }}">
                    Dikirim
                </a>

                <a href="{{ route('buyer.orders', ['status' => 'completed']) }}"
                    class="py-4 px-1 border-b-2 text-sm {{ navClass($activeStatus, 'completed') }}">
                    Selesai
                </a>
            </nav>
        </div>

        {{-- LIST PESANAN --}}
        <div class="space-y-6">
            @forelse ($orders as $order)
                @php([$label, $badgeClass] = statusBadge($order->status))

                <div class="bg-white border rounded-lg shadow-sm overflow-hidden">

                    {{-- HEADER --}}
                    <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-b">
                        <div class="text-sm text-gray-600">
                            {{ $order->created_at->format('d M Y') }} |
                            ORD-{{ $order->id }}
                        </div>

                        <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $badgeClass }}">
                            {{ $label }}
                        </span>
                    </div>

                    {{-- BODY --}}
                    <div class="p-6 flex flex-col sm:flex-row gap-4">
                        <img src="{{ $order->barang->images->first()
                            ? asset('storage/' . $order->barang->images->first()->image_path)
                            : 'https://via.placeholder.com/80' }}"
                            class="w-20 h-20 object-cover rounded border">

                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">
                                {{ $order->barang->nama_barang }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ $order->qty }} Barang
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="text-xs text-gray-500">Total Belanja</p>
                            <p class="text-lg font-bold">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    {{-- FOOTER --}}
                    <div class="px-6 py-4 border-t flex justify-end gap-3">
                        <a href="{{ route('buyer.orders.detail', $order->id) }}"
                            class="px-4 py-2 text-sm border rounded hover:bg-gray-50">
                            Lihat Detail
                        </a>

                        @if ($order->status === 'pending')
                            <a href="{{ route('buyer.orders.pay', $order->id) }}"
                                class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                                Bayar Sekarang
                            </a>
                        @elseif ($order->status === 'waiting_verification')
                            <span class="px-4 py-2 text-sm bg-orange-50 text-orange-700 border rounded">
                                Menunggu Verifikasi
                            </span>
                        @elseif ($order->status === 'shipped')
                            <a href="#" class="px-4 py-2 text-sm bg-purple-600 text-white rounded">
                                Lacak Paket
                            </a>
                        @elseif ($order->status === 'completed')
                            <a href="{{ route('products.show', $order->barang_id) }}"
                                class="px-4 py-2 text-sm bg-blue-50 text-blue-600 border rounded">
                                Beli Lagi
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-16 text-gray-500">
                    Belum ada pesanan.
                </div>
            @endforelse
        </div>
    </div>
@endsection
