@extends('Layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- LEFT COLUMN --}}
        <div class="self-start space-y-2">

            {{-- PROFILE CARD --}}
            <div class="bg-white rounded-xl shadow p-5">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-200">
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center
                                        text-xl font-bold text-gray-500">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <div class="flex-1">
                        <h2 class="font-semibold text-gray-900 leading-tight">
                            {{ $user->name }}
                        </h2>
                        <p class="text-sm text-gray-500">
                            {{ $user->email }}
                        </p>

                        <a href="{{ route('profile.edit') }}"
                        class="inline-flex items-center gap-1 mt-2 text-sm text-indigo-600 hover:underline">
                            ✏️ Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            {{-- ACTION LINK : PUSAT PENJUALAN --}}
            <div class="pl-2 mt-2">
                <a
                    href="{{ route('seller.products') }}"
                    class="group block"
                >
                    <div class="flex items-center gap-2 text-blue-600
                                font-semibold text-sm
                                group-hover:text-blue-700 transition">
                        <span>Pusat Penjualan</span>
                        <span class="transition group-hover:translate-x-1">→</span>
                    </div>

                    <p class="mt-0.5 text-xs text-gray-500">
                        Kelola produk, pesanan, dan statistik penjualan
                    </p>
                </a>
            </div>

        </div>


        {{-- RIGHT : PROFILE DETAILS --}}
        <div class="md:col-span-2 bg-white rounded-xl shadow p-8">

            {{-- HEADER --}}
            <div class="flex flex-col items-center text-center mb-10">
                <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-200 mb-4">
                    @if ($user->avatar)
                        <img src="{{ $user->avatar }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center
                                    text-4xl font-bold text-gray-500">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <h1 class="text-xl font-semibold text-gray-900">
                    {{ $user->name }}
                </h1>

                <span class="mt-1 text-sm text-gray-500">
                    Member sejak {{ $user->created_at->format('M Y') }}
                </span>
            </div>

            {{-- ABOUT --}}
            <div class="mb-8">
                <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">
                    Tentang Pengguna
                </h3>
                <p class="text-gray-700 leading-relaxed bg-gray-50 rounded-lg p-4">
                    {{ $user->deskripsi ?? 'Belum ada deskripsi.' }}
                </p>
            </div>

            {{-- CONTACT --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-xs text-gray-500 mb-1">📧 Email</p>
                    <p class="text-gray-900 font-medium">{{ $user->email }}</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-xs text-gray-500 mb-1">📱 No. Telepon</p>
                    <p class="text-gray-900 font-medium">{{ $user->no_telepon ?? '-' }}</p>
                </div>

                <div class="md:col-span-2 bg-gray-50 rounded-lg p-4">
                    <p class="text-xs text-gray-500 mb-1">📍 Alamat</p>
                    <p class="text-gray-900 font-medium">
                        {{ $user->alamat ?? 'Alamat belum diisi' }}
                    </p>
                </div>
            </div>

            {{-- LOGOUT --}}
            <div class="mt-10 pt-6 border-t flex justify-end">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        onclick="return confirm('Yakin ingin logout?')"
                        class="px-5 py-2.5 text-sm font-medium
                               text-red-600 border border-red-300
                               rounded-md hover:bg-red-50 transition">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
