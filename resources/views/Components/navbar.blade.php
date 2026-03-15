<nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 md:h-20 gap-4">
            
            <a href="/" class="flex-shrink-0 flex items-center group">
                <span class="text-2xl font-black tracking-tighter text-luno-primary group-hover:opacity-80 transition">
                    LUNO<span class="text-luno-secondary text-amber-500">.</span>
                </span>
            </a>

            <div class="hidden lg:block relative" x-data="{ open: false }">
                <button @click="open = !open" @click.away="open = false" 
                        class="flex items-center gap-2 px-4 py-2.5 bg-slate-50 border border-slate-100 rounded-2xl text-slate-700 hover:bg-white hover:border-luno-primary hover:shadow-sm transition-all duration-300 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-luno-primary group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-[11px] font-black uppercase tracking-tight">Bandung, Jawa Barat</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-slate-400 group-hover:text-luno-primary transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="absolute left-0 mt-2 w-56 bg-white border border-slate-100 rounded-2xl shadow-xl z-[60] overflow-hidden p-1.5"
                     style="display: none;">
                    <div class="px-3 py-2 text-[9px] font-black text-slate-400 uppercase tracking-[0.1em]">Pilih Lokasi</div>
                    <a href="#" class="flex items-center justify-between px-3 py-2.5 rounded-xl bg-luno-primary/5 text-luno-primary group transition-colors">
                        <span class="text-xs font-bold">Bandung, Jawa Barat</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    </a>
                    <a href="#" class="flex items-center px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-luno-primary transition-all">
                        <span class="text-xs font-bold">Jakarta, DKI Jakarta</span>
                    </a>
                </div>
            </div>

            <div class="flex-1 max-w-2xl relative group">
                <input type="text" placeholder="Cari barang thrifting..."
                    class="w-full bg-slate-100 text-slate-700 pl-11 pr-4 py-3 rounded-[1.25rem] text-sm border-transparent focus:bg-white focus:ring-4 focus:ring-luno-primary/10 focus:border-luno-primary/30 transition-all duration-300">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-luno-primary transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('buyer.orders') }}" class="hidden md:block text-slate-600 hover:text-luno-primary font-bold text-xs uppercase tracking-wider px-3 transition">Pesanan</a>
                    <a href="{{ route('profile.show') }}" class="flex items-center gap-2 p-1.5 rounded-2xl hover:bg-slate-50 transition border border-transparent hover:border-slate-100">
                        <div class="w-8 h-8 rounded-xl bg-luno-primary text-white flex items-center justify-center text-xs font-black shadow-sm shrink-0">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="hidden sm:block text-xs font-black text-slate-700 uppercase tracking-tight">
                            {{ explode(' ', Auth::user()->name)[0] }}
                        </span>
                    </a>
                @endauth

                @guest
                    <button type="button" onclick="openLogin()"
                        class="bg-luno-primary text-white px-6 py-2.5 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-luno-primary-dark shadow-lg shadow-blue-200 hover:-translate-y-0.5 transition-all active:scale-95">
                        Masuk
                    </button>
                @endguest
            </div>
        </div>
    </div>
</nav>

<div class="hidden md:block bg-luno-primary relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png')"></div>
    <p class="relative z-10 text-center text-[10px] text-white/90 py-2 font-black uppercase tracking-[0.3em]">
        Jual beli barang bekas jadi lebih mudah dan aman bersama Luno Marketplace
    </p>
</div>