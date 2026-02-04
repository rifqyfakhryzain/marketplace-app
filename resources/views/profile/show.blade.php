@extends('Layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;

    $initial = Str::upper(Str::substr($user->name ?? 'U', 0, 1));

    // Avatar URL (kalau avatar berupa URL langsung). Jika avatar Anda path Storage,
    // ganti: $avatarUrl = $user->avatar ? Storage::url($user->avatar) : null;
    $avatarUrl = $user->avatar ?: null;

    // Role badges (pakai spatie/permission)
    $roles = method_exists($user, 'getRoleNames') ? $user->getRoleNames() : collect();

    // Profile completion (silakan sesuaikan field yang Anda anggap penting)
    $checks = [
        'avatar' => !empty($user->avatar),
        'deskripsi' => !empty($user->deskripsi),
        'no_telepon' => !empty($user->no_telepon),
        'alamat' => !empty($user->alamat),
        'email_verified' => !empty($user->email_verified_at ?? null),
    ];

    $filled = collect($checks)->filter()->count();
    $total = collect($checks)->count();
    $completion = $total ? (int) round(($filled / $total) * 100) : 0;

    // Optional stats (kirim dari controller)
    $stats = $stats ?? [
        'orders'   => 0,
        'products' => 0,
        'wishlist' => 0,
        'reviews'  => 0,
    ];
@endphp

<div class="py-12">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- LEFT COLUMN --}}
        <aside class="self-start space-y-4 md:sticky md:top-6">

            {{-- PROFILE CARD --}}
            <div class="bg-white rounded-xl shadow p-5">
                <div class="flex items-start gap-4">

                    {{-- Avatar --}}
                    <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-200 shrink-0">
                        @if ($avatarUrl)
                            <img src="{{ $avatarUrl }}"
                                 class="w-full h-full object-cover"
                                 alt="Avatar {{ $user->name }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-xl font-bold text-gray-500">
                                {{ $initial }}
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-3">
                            <div class="min-w-0">
                                <h2 class="font-semibold text-gray-900 leading-tight truncate">
                                    {{ $user->name }}
                                </h2>
                                <p class="text-sm text-gray-500 truncate">{{ $user->email }}</p>
                            </div>
                        </div>

                        {{-- Badges --}}
                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            {{-- Email verified badge --}}
                            @if (!empty($user->email_verified_at))
                                <span class="text-xs px-2 py-1 rounded-full bg-green-50 text-green-700 border border-green-200">
                                    Email terverifikasi
                                </span>
                            @else
                                <span class="text-xs px-2 py-1 rounded-full bg-yellow-50 text-yellow-800 border border-yellow-200">
                                    Email belum terverifikasi
                                </span>
                            @endif

                            {{-- Role badges --}}
                            @if ($roles->isNotEmpty())
                                @foreach ($roles as $role)
                                    @php
                                        $isAdmin = $role === 'admin';
                                        $isSeller = $role === 'seller';
                                        $badgeClass = $isAdmin
                                            ? 'bg-red-50 text-red-700 border-red-200'
                                            : ($isSeller ? 'bg-blue-50 text-blue-700 border-blue-200' : 'bg-gray-50 text-gray-700 border-gray-200');
                                    @endphp
                                    <span class="text-xs px-2 py-1 rounded-full border {{ $badgeClass }}">
                                        {{ Str::upper($role) }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-xs px-2 py-1 rounded-full bg-gray-50 text-gray-700 border border-gray-200">
                                    USER
                                </span>
                            @endif
                        </div>

                        {{-- Quick actions --}}
                        <div class="flex flex-wrap items-center gap-3 mt-3">
                            @role('admin')
                                <a href="{{ route('admin.index') }}"
                                   class="inline-flex items-center gap-2 text-sm font-semibold text-red-600 hover:underline focus:outline-none focus:ring-2 focus:ring-red-200 rounded">
                                    <span>🛠</span><span>Admin Panel</span>
                                </a>
                            @endrole
                        </div>
                    </div>
                </div>

                {{-- Profile completion --}}
                <div class="mt-5">
                    <div class="flex items-center justify-between">
                        <p class="text-xs text-gray-500">Kelengkapan profil</p>
                        <p class="text-xs font-semibold text-gray-700">{{ $completion }}%</p>
                    </div>
                    <div class="mt-2 w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-600" style="width: {{ $completion }}%"></div>
                    </div>

                    @if ($completion < 100)
                        <p class="mt-2 text-xs text-gray-500">
                            Lengkapi profil untuk meningkatkan kepercayaan dan pengalaman checkout.
                        </p>
                    @endif
                </div>
            </div>

            {{-- SELLER AREA --}}
            <div class="bg-white rounded-xl shadow p-5">
                <h3 class="text-sm font-semibold text-gray-800 mb-2">Area Toko</h3>

                @unlessrole('seller')
                    <form method="POST" action="{{ route('seller.activate') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-center px-4 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition">
                            Aktifkan Toko
                        </button>
                    </form>
                    <p class="mt-2 text-xs text-gray-500">
                        Mulai jual produk, kelola pesanan, dan lihat statistik penjualan.
                    </p>
                @endunlessrole

                @role('seller')
                    <div class="space-y-2">
                        <a href="{{ route('seller.products') }}"
                           class="group flex items-center justify-between px-3 py-2 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 transition">
                            <span class="text-sm font-semibold">Pusat Penjualan</span>
                            <span class="transition group-hover:translate-x-1">→</span>
                        </a>

                        {{-- Opsional: tambahkan link lain jika ada --}}
                        @if (Route::has('seller.orders'))
                            <a href="{{ route('seller.orders') }}"
                               class="flex items-center justify-between px-3 py-2 rounded-lg bg-gray-50 text-gray-700 hover:bg-gray-100 transition">
                                <span class="text-sm font-semibold">Pesanan Toko</span>
                                <span>→</span>
                            </a>
                        @endif
                    </div>
                @endrole
            </div>

            {{-- DANGER ZONE --}}
            <div class="bg-white rounded-xl shadow p-5">
                <h3 class="text-sm font-semibold text-gray-800">Akun</h3>
                <p class="text-xs text-gray-500 mt-1">Keluar dari perangkat ini.</p>

                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit"
                            onclick="return confirm('Yakin ingin logout?')"
                            class="w-full px-4 py-2.5 text-sm font-semibold text-red-600 border border-red-200 rounded-lg hover:bg-red-50 transition">
                        Logout
                    </button>
                </form>

                {{-- Opsional: delete account --}}
                @if (Route::has('profile.destroy'))
                    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Tindakan ini permanen. Yakin hapus akun?')"
                                class="w-full px-4 py-2.5 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                            Hapus Akun
                        </button>
                    </form>
                @endif
            </div>

        </aside>


        {{-- RIGHT COLUMN --}}
        <main class="md:col-span-2 space-y-6">

            {{-- HEADER --}}
            <div class="bg-white rounded-xl shadow p-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-20 rounded-full overflow-hidden bg-gray-200">
                            @if ($avatarUrl)
                                <img src="{{ $avatarUrl }}" class="w-full h-full object-cover" alt="Avatar {{ $user->name }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-3xl font-bold text-gray-500">
                                    {{ $initial }}
                                </div>
                            @endif
                        </div>

                        <div>
                            <h1 class="text-2xl font-semibold text-gray-900">{{ $user->name }}</h1>
                            <p class="text-sm text-gray-500 mt-1">
                                Member sejak {{ optional($user->created_at)->translatedFormat('M Y') ?? '-' }}
                                <span class="mx-2">•</span>
                                Terakhir diperbarui {{ optional($user->updated_at)->diffForHumans() ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('profile.edit') }}"
                           class="px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 transition">
                            Edit Profil
                        </a>

                        @if (empty($user->email_verified_at) && Route::has('verification.notice'))
                            <a href="{{ route('verification.notice') }}"
                               class="px-4 py-2 rounded-lg bg-yellow-50 text-yellow-800 border border-yellow-200 text-sm font-semibold hover:bg-yellow-100 transition">
                                Verifikasi Email
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- STATS --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl shadow p-5">
                    <p class="text-xs text-gray-500">Pesanan</p>
                    <p class="text-2xl font-semibold text-gray-900 mt-1">{{ data_get($stats, 'orders', 0) }}</p>
                </div>
                <div class="bg-white rounded-xl shadow p-5">
                    <p class="text-xs text-gray-500">Produk</p>
                    <p class="text-2xl font-semibold text-gray-900 mt-1">{{ data_get($stats, 'products', 0) }}</p>
                </div>
                <div class="bg-white rounded-xl shadow p-5">
                    <p class="text-xs text-gray-500">Wishlist</p>
                    <p class="text-2xl font-semibold text-gray-900 mt-1">{{ data_get($stats, 'wishlist', 0) }}</p>
                </div>
                <div class="bg-white rounded-xl shadow p-5">
                    <p class="text-xs text-gray-500">Ulasan</p>
                    <p class="text-2xl font-semibold text-gray-900 mt-1">{{ data_get($stats, 'reviews', 0) }}</p>
                </div>
            </div>

            {{-- ABOUT + CONTACT --}}
            <div class="bg-white rounded-xl shadow p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    {{-- ABOUT --}}
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-semibold text-gray-500 uppercase">Tentang</h3>
                            <a href="{{ route('profile.edit') }}" class="text-sm text-indigo-600 hover:underline">
                                Ubah
                            </a>
                        </div>

                        <div class="text-gray-700 leading-relaxed bg-gray-50 rounded-lg p-4 min-h-[96px]">
                            {{ $user->deskripsi ?: 'Belum ada deskripsi. Tambahkan bio singkat agar profil lebih terpercaya.' }}
                        </div>
                    </div>

                    {{-- CONTACT --}}
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Kontak & Alamat</h3>

                        <div class="space-y-3">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs text-gray-500 mb-1">📧 Email</p>
                                <p class="text-gray-900 font-medium break-words">{{ $user->email }}</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs text-gray-500 mb-1">📱 No. Telepon</p>
                                <p class="text-gray-900 font-medium">{{ $user->no_telepon ?: '-' }}</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs text-gray-500 mb-1">📍 Alamat</p>
                                <p class="text-gray-900 font-medium">
                                    {{ $user->alamat ?: 'Alamat belum diisi' }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </main>
    </div>
</div>
@endsection