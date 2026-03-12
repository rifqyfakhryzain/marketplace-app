<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
    <div class="relative">
        <div class="overflow-x-auto pb-4 no-scrollbar flex gap-4 sm:gap-6 items-start md:justify-center">
            
            <a href="{{ route('home') }}" 
               class="group flex flex-col items-center min-w-[70px] sm:min-w-[80px] shrink-0">
                <div class="w-14 h-14 sm:w-16 sm:h-16 flex items-center justify-center rounded-2xl shadow-soft border border-slate-200 bg-white text-slate-400 group-hover:bg-luno-primary group-hover:text-white group-hover:border-luno-primary transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                        <circle cx="12" cy="12" r="10"/>
                    </svg>
                </div>
                <p class="text-[11px] sm:text-xs font-bold mt-2.5 text-slate-500 group-hover:text-luno-primary uppercase tracking-tight transition">
                    Semua
                </p>
            </a>

            @foreach ($categories as $cat)
            <a href="{{ route('kategori.filter', $cat->id) }}" 
               class="group flex flex-col items-center min-w-[70px] sm:min-w-[80px] shrink-0">
                
                <div class="w-14 h-14 sm:w-16 sm:h-16 flex items-center justify-center rounded-2xl shadow-soft border border-blue-50 bg-blue-50 text-luno-primary group-hover:bg-luno-primary group-hover:text-white group-hover:border-luno-primary transition-all duration-300">
                    <div class="w-7 h-7 flex items-center justify-center">
                        {!! $cat->icon !!}
                    </div>
                </div>

                <p class="text-[11px] sm:text-xs font-bold text-slate-500 mt-2.5 text-center group-hover:text-luno-primary uppercase tracking-tight transition">
                    {{ $cat->nama_kategori }}
                </p>
            </a>
            @endforeach

        </div>
    </div>
</div>

<style>
    /* Utility untuk menyembunyikan scrollbar di berbagai browser */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>