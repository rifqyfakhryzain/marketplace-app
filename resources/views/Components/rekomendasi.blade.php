<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 mb-12">

    <div class="flex justify-between items-end mb-8">
        <div class="space-y-1">
            <h2 class="text-2xl font-black tracking-tight text-slate-800 sm:text-3xl">
                Rekomendasi <span class="text-luno-primary">Untuk Kamu</span>
            </h2>
            <p class="text-[11px] sm:text-sm font-medium text-slate-400 max-w-xs sm:max-w-md leading-relaxed">
                Barang pilihan terbaik yang dikurasi khusus berdasarkan aktivitas belanjamu.
            </p>
        </div>
        
        <a href="#" class="flex items-center text-xs sm:text-sm font-black text-luno-primary hover:bg-blue-50 px-3 py-2 rounded-xl transition-all group">
            Lihat Semua 
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 sm:gap-6">
        @forelse ($products as $barang)
            @include('components.product-card', [
                'product' => $barang,
                'horizontal' => false
            ])
        @empty
            <div class="col-span-full py-16 flex flex-col items-center justify-center bg-slate-50/50 rounded-[2rem] border-2 border-dashed border-slate-200">
                <div class="w-20 h-20 bg-white shadow-soft rounded-3xl flex items-center justify-center mb-5">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <h3 class="text-slate-800 font-bold">Belum Ada Rekomendasi</h3>
                <p class="text-slate-400 text-xs mt-1">Coba cari barang impianmu untuk melihat hasil kurasi di sini.</p>
                <a href="{{ route('home') }}" class="mt-6 px-6 py-2 bg-white border border-slate-200 text-slate-600 text-xs font-bold rounded-xl hover:bg-slate-50 transition">
                    Mulai Jelaja
                </a>
            </div>
        @endforelse
    </div>

</div>