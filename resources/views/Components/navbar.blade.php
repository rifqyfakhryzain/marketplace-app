<nav class="bg-blue-600">

    <!-- BARIS ATAS -->
    <div class="max-w-7xl mx-auto px-6 py-2 flex items-center gap-4">

        <!-- LOGO -->
        <a href="/"
           class="w-[40px] h-[40px]
                  bg-white/20 rounded-full
                  flex items-center justify-center
                  text-white text-sm shrink-0
                  hover:bg-white/30 transition">
            Logo
        </a>

        <!-- LOKASI -->
        <div class="relative shrink-0">
            <select class="appearance-none bg-white text-gray-700
                           px-4 py-2 pr-10 rounded-full text-sm
                           border border-gray-200 focus:outline-none">
                <option>Bandung, Jawa Barat</option>
                <option>Jakarta Selatan, DKI Jakarta</option>
            </select>
            <span class="pointer-events-none absolute right-3 top-1/2
                         -translate-y-1/2 text-gray-500 text-xs">▼</span>
        </div>

        <!-- SEARCH -->
        <div class="relative flex-1">
            <input
                type="text"
                placeholder="Cari barang..."
                class="w-full bg-white text-gray-700
                       pl-5 pr-20 py-2.5 rounded-full text-sm
                       border border-gray-200 focus:outline-none"
            >
            <button
                class="absolute right-2 top-1/2 -translate-y-1/2
                       px-4 py-1.5 rounded-full bg-blue-500
                       text-white text-sm font-semibold">
                Cari
            </button>
        </div>

        <!-- KANAN -->
        @auth
            <div class="flex items-center gap-3 shrink-0">

                <!-- USER -->
                <a href="{{ route('profile.show') }}"
                   class="flex items-center gap-2 hover:opacity-90 transition">

                    <span class="text-white text-sm font-medium">
                        {{ Auth::user()->name }}
                    </span>

                    <div class="w-9 h-9 rounded-full
                                bg-white text-blue-600
                                flex items-center justify-center
                                text-sm font-bold shrink-0">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </a>

                <!-- PESANAN -->
                <a href="/pesanan"
                   class="bg-white text-blue-600
                          px-4 py-2 rounded-full
                          text-sm font-semibold shrink-0">
                    Pesanan
                </a>

                <!-- LOGOUT -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="text-white text-sm hover:underline">
                        Logout
                    </button>
                </form>

            </div>
        @endauth

        @guest
            <button
                type="button"
                onclick="openLogin()"
                class="bg-white text-blue-600
                       px-4 py-2 rounded-full
                       text-sm font-semibold">
                Masuk / Daftar
            </button>
        @endguest

    </div>

    <!-- BARIS BAWAH -->
    <div class="max-w-7xl mx-auto px-6 pb-2 text-center">
        <p class="text-base text-white font-medium">
            Jual beli barang bekas jadi lebih mudah dan aman
        </p>
    </div>

</nav>
