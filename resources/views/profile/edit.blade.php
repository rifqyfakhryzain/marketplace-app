@extends('Layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- LEFT : PROFILE CONTEXT (READ ONLY) --}}
        <div class="bg-white rounded-xl shadow p-5 self-start">
            <div class="flex items-center gap-4">

                {{-- AVATAR --}}
                <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-200">
                    @if ($user->avatar)
                        <img
                            src="{{ $user->avatar }}"
                            class="w-full h-full object-cover"
                        >
                    @else
                        <div class="w-full h-full flex items-center justify-center
                                    text-xl font-bold text-gray-500">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                {{-- USER INFO --}}
                <div class="flex-1">
                    <h2 class="font-semibold text-gray-900 leading-tight">
                        {{ $user->name }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        {{ $user->email }}
                    </p>
                </div>

            </div>
        </div>

        {{-- RIGHT : EDIT PROFILE FORM --}}
        <div class="md:col-span-2 bg-white rounded-xl shadow p-8">

            {{-- AVATAR PREVIEW (FRONTEND ONLY) --}}
            <div class="flex flex-col items-center mb-10">

                <div
                    class="relative w-32 h-32 rounded-full overflow-hidden bg-gray-200
                        cursor-pointer hover:opacity-90 transition"
                    onclick="document.getElementById('avatarInput').click()"
                >
                    <img
                        id="avatarImg"
                        src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}"
                        class="w-full h-full object-cover"
                    >

                    {{-- HOVER OVERLAY --}}
                    <div
                        class="absolute inset-0 bg-black/40 text-white
                            flex items-center justify-center text-sm
                            opacity-0 hover:opacity-100 transition"
                    >
                        Ganti Foto
                    </div>
                </div>

                <input
                    type="file"
                    id="avatarInput"
                    accept="image/*"
                    class="hidden"
                    onchange="previewAvatar(event)"
                >
            </div>


            <h1 class="text-xl font-semibold text-gray-900 mb-6">
                Edit Profile
            </h1>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('PATCH')

                {{-- NAME --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        class="w-full rounded-md border-gray-300
                               focus:border-indigo-500 focus:ring-indigo-500"
                    >
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- BIO --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi
                    </label>
                    <textarea
                        name="bio"
                        rows="4"
                        class="w-full rounded-md border-gray-300
                               focus:border-indigo-500 focus:ring-indigo-500"
                    >{{ old('bio', $user->bio) }}</textarea>
                    @error('bio')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- PHONE --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        No. Telepon
                    </label>
                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone', $user->phone) }}"
                        class="w-full rounded-md border-gray-300
                               focus:border-indigo-500 focus:ring-indigo-500"
                    >
                    @error('phone')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- ADDRESS --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Alamat
                    </label>
                    <textarea
                        name="address"
                        rows="2"
                        class="w-full rounded-md border-gray-300
                               focus:border-indigo-500 focus:ring-indigo-500"
                    >{{ old('address', $user->address) }}</textarea>
                    @error('address')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- ACTION BAR --}}
                <div class="mt-10 -mx-8 px-8 py-5 bg-gray-50 border-t
                            flex items-center justify-between">

                    <span class="text-sm text-gray-500">
                        Pastikan data sudah benar sebelum menyimpan.
                    </span>

                    <div class="flex gap-3">
                        <a
                            href="{{ route('profile.show') }}"
                            class="px-5 py-2.5 text-sm font-medium
                                rounded-md border border-gray-300
                                text-gray-700 bg-white
                                hover:bg-gray-100 transition"
                        >
                            Batal
                        </a>

                        <button
                        type="submit"
                        class="inline-flex items-center
                            px-6 py-2.5
                            text-sm font-semibold
                            text-white
                            bg-blue-600
                            rounded-md
                            shadow-sm
                            hover:bg-blue-700
                            focus:outline-none focus:ring-2 focus:ring-blue-500
                            transition"
                    >
                        Simpan Perubahan
                    </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>

<script>
    function previewAvatar(event) {
        const file = event.target.files[0];
        if (!file) return;

        const img = document.getElementById('avatarImg');
        img.src = URL.createObjectURL(file);
    }
</script>

@endsection
