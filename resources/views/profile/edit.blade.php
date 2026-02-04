@extends('Layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;

    $initial = Str::upper(Str::substr($user->name ?? 'U', 0, 1));
    $avatarUrl = $user->avatar ?: 'https://ui-avatars.com/api/?name='.urlencode($user->name ?? 'User');

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

    $roles = method_exists($user, 'getRoleNames') ? $user->getRoleNames() : collect();
@endphp

<div class="py-12">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- LEFT : PROFILE CONTEXT (READ ONLY) --}}
        <aside class="space-y-4 self-start md:sticky md:top-6">

            {{-- Profile card --}}
            <div class="bg-white rounded-xl shadow p-5">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-200 shrink-0">
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" class="w-full h-full object-cover" alt="Avatar {{ $user->name }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-xl font-bold text-gray-500">
                                {{ $initial }}
                            </div>
                        @endif
                    </div>

                    <div class="min-w-0 flex-1">
                        <h2 class="font-semibold text-gray-900 leading-tight truncate">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-500 truncate">{{ $user->email }}</p>

                        {{-- Badges --}}
                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            @if (!empty($user->email_verified_at))
                                <span class="text-xs px-2 py-1 rounded-full bg-green-50 text-green-700 border border-green-200">
                                    Email terverifikasi
                                </span>
                            @else
                                <span class="text-xs px-2 py-1 rounded-full bg-yellow-50 text-yellow-800 border border-yellow-200">
                                    Email belum terverifikasi
                                </span>
                            @endif

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
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Completion --}}
                <div class="mt-5">
                    <div class="flex items-center justify-between">
                        <p class="text-xs text-gray-500">Kelengkapan profil</p>
                        <p class="text-xs font-semibold text-gray-800">{{ $completion }}%</p>
                    </div>
                    <div class="mt-2 w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-600" style="width: {{ $completion }}%"></div>
                    </div>

                    {{-- Tips --}}
                    @php
                        $tips = [];
                        if (empty($user->email_verified_at)) $tips[] = 'Verifikasi email untuk keamanan akun.';
                        if (empty($user->no_telepon)) $tips[] = 'Tambahkan nomor telepon agar mudah dihubungi.';
                        if (empty($user->alamat)) $tips[] = 'Isi alamat untuk mempermudah pengiriman.';
                        if (empty($user->deskripsi)) $tips[] = 'Tambahkan deskripsi singkat untuk meningkatkan kepercayaan.';
                    @endphp

                    @if (!empty($tips))
                        <div class="mt-4 bg-gray-50 border border-gray-100 rounded-lg p-3">
                            <p class="text-xs font-semibold text-gray-700 mb-2">Saran cepat</p>
                            <ul class="text-xs text-gray-600 list-disc pl-5 space-y-1">
                                @foreach ($tips as $tip)
                                    <li>{{ $tip }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="mt-4 pt-4 border-t text-xs text-gray-500">
                    Terakhir diperbarui: <span class="font-medium text-gray-700">{{ optional($user->updated_at)->diffForHumans() }}</span>
                </div>
            </div>

            {{-- Quick links --}}
            <div class="bg-white rounded-xl shadow p-5">
                <h3 class="text-sm font-semibold text-gray-900">Aksi</h3>

                <div class="mt-3 space-y-2">
                    <a href="{{ route('profile.show') }}"
                       class="block text-sm text-indigo-600 hover:underline">
                        ← Kembali ke Profil
                    </a>

                    @if (Route::has('password.edit'))
                        <a href="{{ route('password.edit') }}"
                           class="block text-sm text-gray-700 hover:underline">
                            🔒 Ubah Password
                        </a>
                    @endif

                    @if (empty($user->email_verified_at) && Route::has('verification.notice'))
                        <a href="{{ route('verification.notice') }}"
                           class="block text-sm text-yellow-800 hover:underline">
                            ✉️ Verifikasi Email
                        </a>
                    @endif
                </div>
            </div>

        </aside>


        {{-- RIGHT : EDIT PROFILE FORM --}}
        <main class="md:col-span-2 bg-white rounded-xl shadow p-8">

            {{-- Alerts --}}
            @if (session('status'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
                    <p class="text-sm font-semibold text-red-800">Ada kesalahan pada input:</p>
                    <ul class="mt-2 text-sm text-red-700 list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex items-start justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-xl font-semibold text-gray-900">Edit Profil</h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Perbarui informasi dasar agar akun terlihat lebih terpercaya dan proses transaksi lebih lancar.
                    </p>
                </div>
            </div>

            <form id="profileForm"
                  method="POST"
                  action="{{ route('profile.update') }}"
                  enctype="multipart/form-data"
                  class="space-y-8">
                @csrf
                @method('PATCH')

                {{-- SECTION: AVATAR --}}
                <section>
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-sm font-semibold text-gray-700 uppercase">Foto Profil</h2>
                        <p class="text-xs text-gray-500">JPG/PNG, maks 2MB</p>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center gap-5">
                        {{-- Preview --}}
                        <div class="relative w-28 h-28 rounded-full overflow-hidden bg-gray-200 shrink-0">
                            <img id="avatarImg" src="{{ $avatarUrl }}" class="w-full h-full object-cover" alt="Preview avatar">
                        </div>

                        {{-- Dropzone / Controls --}}
                        <div class="flex-1">
                            <div id="dropzone"
                                 class="rounded-lg border border-dashed border-gray-300 bg-gray-50 p-4 hover:bg-gray-100 transition cursor-pointer"
                                 onclick="document.getElementById('avatarInput').click()">
                                <p class="text-sm text-gray-700 font-medium">Klik untuk pilih foto</p>
                                <p class="text-xs text-gray-500 mt-1">Atau drag & drop file ke area ini.</p>
                                <p id="avatarHint" class="text-xs text-gray-500 mt-2"></p>
                            </div>

                            <div class="mt-3 flex flex-wrap gap-3">
                                <button type="button"
                                        class="px-4 py-2 text-sm font-medium rounded-md border border-gray-300 text-gray-700 bg-white hover:bg-gray-100 transition"
                                        onclick="document.getElementById('avatarInput').click()">
                                    Pilih Foto
                                </button>

                                <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                                    <input type="checkbox" name="remove_avatar" value="1"
                                           class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                    Hapus foto profil
                                </label>
                            </div>

                            <input type="file"
                                   name="avatar"
                                   id="avatarInput"
                                   accept="image/*"
                                   class="hidden">
                            @error('avatar')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>

                {{-- SECTION: BASIC INFO --}}
                <section>
                    <h2 class="text-sm font-semibold text-gray-700 uppercase mb-3">Info Dasar</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Nama <span class="text-red-600">*</span>
                            </label>
                            <input type="text"
                                   name="name"
                                   required
                                   autocomplete="name"
                                   value="{{ old('name', $user->name) }}"
                                   class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @error('name')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Email (read-only)
                            </label>
                            <input type="email"
                                   value="{{ $user->email }}"
                                   readonly
                                   class="w-full rounded-md border-gray-200 bg-gray-50 text-gray-600">
                            <p class="text-xs text-gray-500 mt-1">
                                Email tidak diubah di halaman ini.
                                @if (empty($user->email_verified_at) && Route::has('verification.notice'))
                                    <a class="text-indigo-600 hover:underline" href="{{ route('verification.notice') }}">Verifikasi sekarang</a>.
                                @endif
                            </p>
                        </div>
                    </div>
                </section>

                {{-- SECTION: CONTACT --}}
                <section>
                    <h2 class="text-sm font-semibold text-gray-700 uppercase mb-3">Kontak</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                No. Telepon
                            </label>
                            <input type="tel"
                                   name="no_telepon"
                                   autocomplete="tel"
                                   placeholder="contoh: 08xxxxxxxxxx"
                                   value="{{ old('no_telepon', $user->no_telepon) }}"
                                   class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <p class="text-xs text-gray-500 mt-1">Gunakan nomor aktif untuk konfirmasi/pengiriman.</p>
                            @error('no_telepon')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Alamat
                            </label>
                            <textarea name="alamat"
                                      rows="3"
                                      autocomplete="street-address"
                                      placeholder="Nama jalan, kecamatan, kota, provinsi, kode pos"
                                      class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('alamat', $user->alamat) }}</textarea>
                            @error('alamat')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>

                {{-- SECTION: ABOUT --}}
                <section>
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-sm font-semibold text-gray-700 uppercase">Tentang</h2>
                        <p class="text-xs text-gray-500"><span id="descCount">0</span>/200</p>
                    </div>

                    <textarea id="desc"
                              name="deskripsi"
                              rows="4"
                              maxlength="200"
                              placeholder="Tulis bio singkat (misalnya minat, aktivitas, atau info toko jika seller)."
                              class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi', $user->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </section>

                {{-- ACTION BAR --}}
                <div class="mt-10 -mx-8 px-8 py-5 bg-gray-50 border-t flex items-center justify-between gap-4">
                    <span id="dirtyHint" class="text-sm text-gray-500">
                        Pastikan data sudah benar sebelum menyimpan.
                    </span>

                    <div class="flex gap-3">
                        <a href="{{ route('profile.show') }}"
                           class="px-5 py-2.5 text-sm font-medium rounded-md border border-gray-300 text-gray-700 bg-white hover:bg-gray-100 transition">
                            Batal
                        </a>

                        <button type="submit"
                                class="inline-flex items-center px-6 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </main>

    </div>
</div>

<script>
    // --- Description counter
    const desc = document.getElementById('desc');
    const descCount = document.getElementById('descCount');
    function updateCount() {
        descCount.textContent = (desc.value || '').length;
    }
    updateCount();
    desc.addEventListener('input', updateCount);

    // --- Avatar preview + basic validation
    const avatarInput = document.getElementById('avatarInput');
    const avatarImg = document.getElementById('avatarImg');
    const avatarHint = document.getElementById('avatarHint');
    let objectUrl = null;

    function setPreview(file) {
        if (!file) return;

        // Validate type
        if (!file.type.startsWith('image/')) {
            avatarHint.textContent = 'File harus berupa gambar.';
            avatarHint.className = 'text-xs mt-2 text-red-600';
            return;
        }

        // Validate size (2MB)
        const max = 2 * 1024 * 1024;
        if (file.size > max) {
            avatarHint.textContent = 'Ukuran file terlalu besar. Maks 2MB.';
            avatarHint.className = 'text-xs mt-2 text-red-600';
            return;
        }

        if (objectUrl) URL.revokeObjectURL(objectUrl);
        objectUrl = URL.createObjectURL(file);
        avatarImg.src = objectUrl;

        avatarHint.textContent = `Dipilih: ${file.name}`;
        avatarHint.className = 'text-xs mt-2 text-gray-600';
    }

    avatarInput.addEventListener('change', (e) => setPreview(e.target.files[0]));

    // --- Dropzone
    const dropzone = document.getElementById('dropzone');
    ['dragenter','dragover'].forEach(evt => {
        dropzone.addEventListener(evt, (e) => {
            e.preventDefault();
            dropzone.classList.add('ring-2','ring-indigo-200','border-indigo-300');
        });
    });
    ['dragleave','drop'].forEach(evt => {
        dropzone.addEventListener(evt, (e) => {
            e.preventDefault();
            dropzone.classList.remove('ring-2','ring-indigo-200','border-indigo-300');
        });
    });
    dropzone.addEventListener('drop', (e) => {
        const file = e.dataTransfer.files?.[0];
        if (!file) return;
        // Assign to input so it gets submitted
        const dt = new DataTransfer();
        dt.items.add(file);
        avatarInput.files = dt.files;
        setPreview(file);
    });

    // --- Dirty state hint
    const form = document.getElementById('profileForm');
    const dirtyHint = document.getElementById('dirtyHint');
    let dirty = false;

    form.addEventListener('input', () => {
        if (dirty) return;
        dirty = true;
        dirtyHint.textContent = 'Ada perubahan yang belum disimpan.';
        dirtyHint.className = 'text-sm text-yellow-700';
    });
</script>
@endsection