@extends('layouts.app')

@section('content')
@php
    // --- DUMMY DATA SETUP ---
    // Simulasi data order yang lebih lengkap
    if (!isset($order)) {
        $order = (object) [
            'id' => 123,
            'order_code' => 'ORD-20260125-001',
            'status' => 'shipped', // COBA GANTI: 'unpaid', 'processed', 'shipped', 'completed'
            'payment_method' => 'Transfer Bank BCA',
            'payment_deadline' => '26 Jan 2026 14:00', // Khusus unpaid
            'created_at' => '25 Jan 2026 13:45',
            'shipping_cost' => 15000,
            'total_amount' => 4515000, // 4.5jt + 15rb

            // Info Penerima
            'shipping' => (object) [
                'name' => 'Hennessy',
                'phone' => '0812-3456-7890',
                'address' => 'Jl. Jenderal Sudirman No. Kav 52-53, RT.5/RW.3, Senayan, Kec. Kby. Baru, Kota Jakarta Selatan, 12190',
            ],

            // Item Belanja
            'items' => [
                (object) [
                    'product_name' => 'iPhone 11 128GB - Black Inter',
                    'image' => 'https://via.placeholder.com/150?text=iPhone',
                    'qty' => 1,
                    'price' => 4500000,
                    'subtotal' => 4500000,
                    'note' => 'Packing kayu ya gan'
                ],
            ],

            // Info Resi (jika shipped/completed)
            'shipment' => (object) [
                'courier' => 'JNE - Reguler',
                'tracking_number' => 'JP123456789',
                'last_update' => '26 Jan 2026 08:00',
                'last_location' => 'Manifested at Jakarta',
                'history' => [
                    ['date' => '26 Jan 08:00', 'desc' => 'Paket diterima oleh JNE'],
                    ['date' => '25 Jan 20:00', 'desc' => 'Paket telah di-pickup kurir'],
                ]
            ],
        ];
    }

    // Helper untuk Stepper Timeline
    $steps = ['unpaid', 'processed', 'shipped', 'completed'];
    $currentStepIndex = array_search($order->status, $steps);
    
    // Label status untuk badge
    $statusLabels = [
        'unpaid' => ['text' => 'Menunggu Pembayaran', 'class' => 'bg-yellow-100 text-yellow-800'],
        'processed' => ['text' => 'Diproses Penjual', 'class' => 'bg-blue-100 text-blue-800'],
        'shipped' => ['text' => 'Sedang Dikirim', 'class' => 'bg-purple-100 text-purple-800'],
        'completed' => ['text' => 'Selesai', 'class' => 'bg-green-100 text-green-800'],
    ];
    $currentLabel = $statusLabels[$order->status];
@endphp

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- HEADER & NAVIGASI --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <a href="{{ route('buyer.orders') }}" class="flex items-center text-gray-500 hover:text-blue-600 transition">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
        <div class="text-right">
            <p class="text-sm text-gray-500">No. Pesanan</p>
            <h1 class="text-xl font-bold text-gray-800">{{ $order->order_code }}</h1>
        </div>
    </div>

    {{-- STEPPER / TIMELINE --}}
    <div class="bg-white p-6 rounded-lg border shadow-sm mb-6">
        <div class="flex items-center justify-between relative">
            {{-- Garis Background --}}
            <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-gray-200 -z-0"></div>
            
            {{-- Loop Steps --}}
            @foreach(['Belum Bayar', 'Diproses', 'Dikirim', 'Selesai'] as $key => $label)
                @php
                    $isCompleted = $key <= $currentStepIndex;
                    $isCurrent = $key === $currentStepIndex;
                @endphp
                <div class="relative z-10 flex flex-col items-center bg-white px-2">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold border-2 
                        {{ $isCompleted ? 'bg-blue-600 border-blue-600 text-white' : 'bg-white border-gray-300 text-gray-400' }}">
                        @if($key < $currentStepIndex) 
                            ✓ 
                        @else 
                            {{ $key + 1 }} 
                        @endif
                    </div>
                    <span class="text-xs mt-2 font-medium {{ $isCurrent ? 'text-blue-600' : 'text-gray-500' }}">
                        {{ $label }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- KOLOM KIRI (DETAIL UTAMA) --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- ALERT STATUS --}}
            @if ($order->status === 'unpaid')
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Segera lakukan pembayaran sebelum <span class="font-bold">{{ $order->payment_deadline }}</span> agar pesanan tidak dibatalkan otomatis.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- ITEM PESANAN --}}
            <div class="bg-white rounded-lg border shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
                    <h2 class="font-semibold text-gray-700">Detail Produk</h2>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $currentLabel['class'] }}">
                        {{ $currentLabel['text'] }}
                    </span>
                </div>
                <div class="p-6 divide-y">
                    @foreach ($order->items as $item)
                        <div class="flex flex-col sm:flex-row gap-4 py-4 first:pt-0 last:pb-0">
                            <img src="{{ $item->image }}" alt="{{ $item->product_name }}" class="w-20 h-20 object-cover rounded-md border">
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900">{{ $item->product_name }}</h3>
                                @if(isset($item->note))
                                    <p class="text-xs text-gray-500 mt-1 italic">Catatan: "{{ $item->note }}"</p>
                                @endif
                                <p class="text-sm text-gray-500 mt-1">{{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- INFORMASI PENGIRIMAN & PELACAKAN --}}
            <div class="bg-white rounded-lg border shadow-sm p-6">
                <h2 class="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                    Info Pengiriman
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Alamat --}}
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold mb-2">Alamat Tujuan</p>
                        <div class="text-sm text-gray-700">
                            <p class="font-bold">{{ $order->shipping->name }}</p>
                            <p>{{ $order->shipping->phone }}</p>
                            <p class="mt-1 text-gray-500">{{ $order->shipping->address }}</p>
                        </div>
                    </div>

                    {{-- Data Kurir / Resi --}}
                    @if(in_array($order->status, ['shipped', 'completed']))
                        <div class="bg-blue-50 p-4 rounded-md border border-blue-100">
                            <p class="text-xs text-blue-500 uppercase font-semibold mb-2">Lacak Paket</p>
                            <p class="text-sm font-semibold">{{ $order->shipment->courier }}</p>
                            <p class="text-sm font-mono bg-white inline-block px-2 py-1 rounded border mt-1">
                                {{ $order->shipment->tracking_number }}
                            </p>
                            <p class="text-xs text-gray-500 mt-2">Update Terakhir: {{ $order->shipment->last_update }}</p>
                            <p class="text-xs text-gray-500 font-medium">{{ $order->shipment->last_location }}</p>
                        </div>
                    @else
                        <div class="flex items-center justify-center bg-gray-50 rounded border border-dashed h-full p-4">
                            <p class="text-sm text-gray-400 italic">Informasi resi belum tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN (SUMMARY & ACTIONS) --}}
        <div class="lg:col-span-1 space-y-6">
            
            {{-- CARD RINCIAN BIAYA --}}
            <div class="bg-white rounded-lg border shadow-sm p-6 sticky top-6">
                <h2 class="font-semibold text-gray-700 mb-4">Rincian Pembayaran</h2>
                
                <div class="space-y-3 text-sm text-gray-600 border-b pb-4 mb-4">
                    <div class="flex justify-between">
                        <span>Metode Bayar</span>
                        <span class="font-medium text-gray-900">{{ $order->payment_method }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Waktu Pesan</span>
                        <span>{{ $order->created_at }}</span>
                    </div>
                </div>

                <div class="space-y-2 text-sm text-gray-600 mb-4">
                    <div class="flex justify-between">
                        <span>Total Harga ({{ count($order->items) }} Barang)</span>
                        <span>Rp {{ number_format($order->items[0]->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Total Ongkos Kirim</span>
                        <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-4 border-t border-dashed">
                    <span class="font-bold text-gray-800">Total Belanja</span>
                    <span class="font-bold text-blue-600 text-lg">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>

                {{-- TOMBOL AKSI UTAMA --}}
                <div class="mt-6 space-y-3">
                    @if ($order->status === 'unpaid')
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-md transition">
                            Bayar Sekarang
                        </button>
                        <button class="w-full bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 font-medium py-2 rounded-lg transition text-sm">
                            Batalkan Pesanan
                        </button>

                    @elseif ($order->status === 'shipped')
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-md transition">
                            Pesanan Diterima
                        </button>
                        <p class="text-xs text-center text-gray-500 mt-2">
                            Klik jika paket sudah sampai dan sesuai.
                        </p>

                    @elseif ($order->status === 'completed')
                        <button class="w-full bg-yellow-400 hover:bg-yellow-500 text-yellow-900 font-semibold py-3 rounded-lg shadow-sm transition">
                            ★ Beri Ulasan
                        </button>
                        <button class="w-full bg-blue-50 hover:bg-blue-100 text-blue-600 font-medium py-2 rounded-lg transition border border-blue-200">
                            Beli Lagi
                        </button>
                    @endif
                </div>
            </div>
            
            {{-- BANTUAN --}}
            <div class="bg-gray-50 rounded-lg p-4 text-center border">
                <p class="text-sm text-gray-600 mb-2">Punya kendala dengan pesanan ini?</p>
                <a href="#" class="text-blue-600 font-medium text-sm hover:underline">Hubungi Penjual</a>
            </div>

        </div>
    </div>
</div>
@endsection