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
                                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h2 class="font-bold text-gray-900 text-sm">Menu Penjual</h2>
                                    <p class="text-xs text-gray-500">Pengelola Toko</p>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Menu Links --}}
                        <nav class="p-2 space-y-1">
                            <a href="{{ route('seller.statistics') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                                {{ request()->routeIs('seller.statistics') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                Dashboard & Statistik
                            </a>

                            <a href="{{ route('seller.orders') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                                {{ request()->routeIs('seller.orders') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                Pesanan
                            </a>

                            <a href="{{ route('seller.products') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                                {{ request()->routeIs('seller.products*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                Produk Saya
                            </a>
                        </nav>
                    </div>
                </div>

                {{-- MAIN CONTENT --}}
                <div class="lg:col-span-9 space-y-6">

                    {{-- HEADER & ACTIONS --}}
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <h1 class="text-2xl font-bold text-gray-800">
                            Product Management
                        </h1>
                        <a href="{{ route('seller.products.create') }}"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-600 transition shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Add New Product
                        </a>
                    </div>

                    {{-- FILTER BAR --}}
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex flex-col sm:flex-row gap-4">
                        <div class="flex-1 relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
                            <input type="text" placeholder="Search product name..." 
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-600 focus:border-blue-600">
                        </div>
                        <div class="sm:w-48">
                            <select class="w-full border border-gray-300 rounded-lg text-sm py-2 px-3 focus:ring-blue-600 focus:border-blue-600">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="low_stock">Low Stock</option>
                            </select>
                        </div>
                    </div>

                    {{-- TABLE CARD --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="bg-gray-50 text-gray-500 uppercase font-semibold text-xs">
                                    <tr>
                                        <th class="px-6 py-4">Product Details</th>
                                        <th class="px-6 py-4">Price</th>
                                        <th class="px-6 py-4">Stock</th>
                                        <th class="px-6 py-4">Status</th>
                                        <th class="px-6 py-4 text-right">Actions</th>
                                    </tr>
                                </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse ($barangs as $barang)
                                <tr>
                                    <td class="px-3 py-3 flex items-center gap-3">
                                        <div class="w-12 h-12 bg-gray-200 rounded"></div>
                                        <div>
                                            <p class="font-medium">{{ $barang->nama_barang }}</p>
                                            <p class="text-xs text-gray-500">
                                                Dibuat: {{ $barang->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </td>

                                            {{-- Price --}}
                                            <td class="px-6 py-4 font-medium text-gray-900">
                                                Rp {{ number_format($barang->harga, 0, ',', '.') }}
                                            </td>

                                            {{-- Stock --}}
                                            <td class="px-6 py-4">
                                                @if($barang->stok <= 5)
                                                    <span class="text-red-600 font-bold flex items-center gap-1">
                                                        {{ $barang->stok }}
                                                        <span title="Low Stock" class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                                                    </span>
                                                @else
                                                    <span class="text-gray-700">{{ $barang->stok }}</span>
                                                @endif
                                            </td>

                                            {{-- Status --}}
                                            <td class="px-6 py-4">
                                                @if ($barang->status === 'tersedia')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Active
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        Inactive
                                                    </span>
                                                @endif
                                            </td>

                                            {{-- Actions --}}
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    
                                                    {{-- VIEW --}}
                                                    <a href="{{ route('seller.products.show', $barang->id) }}" 
                                                       class="p-1.5 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-md transition" title="View Details">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                    </a>

                                                    {{-- EDIT --}}
                                                    <a href="{{ route('seller.products.edit', $barang->id) }}" 
                                                       class="p-1.5 text-gray-500 hover:text-amber-600 hover:bg-amber-50 rounded-md transition" title="Edit">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                    </a>

                                                    {{-- DELETE --}}
                                                    <form action="{{ route('seller.products.destroy', $barang->id) }}" method="POST"
                                                          onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="p-1.5 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-md transition" title="Delete">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-12 text-center">
                                                <div class="flex flex-col items-center justify-center">
                                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                                    </div>
                                                    <h3 class="text-lg font-medium text-gray-900">No products found</h3>
                                                    <p class="text-gray-500 max-w-sm mt-1 mb-6">You haven't added any products yet. Start selling by adding your first product.</p>
                                                    <a href="{{ route('seller.products.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-blue-600 transition">
                                                        Add First Product
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        {{-- PAGINATION (Requires $barangs to be paginated in Controller) --}}
                        @if(method_exists($barangs, 'links'))
                            <div class="px-6 py-4 border-t border-gray-100">
                                {{ $barangs->links() }}
                            </div>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection