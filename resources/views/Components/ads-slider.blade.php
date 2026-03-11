<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 relative">
    <div class="swiper adsSwiper !pb-12">
        <div class="swiper-wrapper">

            @php
                $ads = [
                    [
                        'title' => 'Gudang Penuh?',
                        'subtitle' => 'Jual barang bekasmu jadi cuan instan hari ini!',
                        'cta' => 'Mulai Jual',
                        'color' => 'bg-indigo-600',
                        'bg_pattern' => 'https://www.transparenttextures.com/patterns/cubes.png',
                        'icon' => '<svg class="w-20 h-20 text-white/10 rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.15-1.46-3.27-3.4h1.96c.1 1.05 1.18 1.91 2.53 1.91 1.38 0 2.53-.83 2.53-1.94 0-2.4-3.55-2.5-3.55-5.38 0-1.5 1.25-2.73 2.8-3.03V4.5h2.67v1.97c1.37.28 2.5 1.25 2.61 2.78h-1.96c-.12-.83-1.03-1.45-2.08-1.45-1.06 0-1.85.81-1.85 1.88 0 2.45 3.55 2.44 3.55 5.31 0 1.6-1.3 2.92-2.92 3.1z"/></svg>',
                    ],
                    [
                        'title' => 'Gadget Impian',
                        'subtitle' => 'Upgrade HP gak perlu mahal. Cek koleksi second.',
                        'cta' => 'Cari Gadget',
                        'color' => 'bg-sky-500',
                        'bg_pattern' => 'https://www.transparenttextures.com/patterns/circuit-board.png',
                        'icon' => '<svg class="w-20 h-20 text-white/10 -rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M17 1.01L7 1c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V3c0-1.1-.9-1.99-2-1.99zM17 19H7V5h10v14z"/></svg>',
                    ],
                    [
                        'title' => 'Thrifting Style',
                        'subtitle' => 'Outfit branded harga miring. Keren & hemat.',
                        'cta' => 'Lihat Fashion',
                        'color' => 'bg-slate-800',
                        'bg_pattern' => 'https://www.transparenttextures.com/patterns/carbon-fibre.png',
                        'icon' => '<svg class="w-20 h-20 text-white/10 rotate-6" fill="currentColor" viewBox="0 0 24 24"><path d="M21.96 6.01c-.13-.35-.29-.68-.48-.99-.54-.88-1.28-1.61-2.17-2.16l-.01-.01c-.34-.19-.7-.34-1.07-.46-.35-.11-.72-.18-1.09-.2-.05 0-.1 0-.15 0H7.01c-.05 0-.1 0-.15.01-.37.02-.73.08-1.09.2-.38.12-.73.27-1.07.46l-.01.01c-.88.54-1.63 1.28-2.17 2.16-.19.3-.35.63-.48.99-.12.37-.2.75-.22 1.15v.07c0 .04 0 .09 0 .13v9.06c0 2.21 1.79 4 4 4h12.34c2.21 0 4-1.79 4-4V7.29c0-.04 0-.09 0-.13v-.06c-.02-.4-.1-.79-.22-1.09zM15.5 12c-1.93 0-3.5-1.57-3.5-3.5S13.57 5 15.5 5 19 6.57 19 8.5 17.43 12 15.5 12z"/></svg>',
                    ]
                ];
            @endphp

            @foreach ($ads as $ad)
                <div class="swiper-slide p-1">
                    <div class="{{ $ad['color'] }} text-white h-[160px] md:h-[200px] rounded-[2rem] px-8 py-6 relative overflow-hidden shadow-xl shadow-slate-200/50 flex flex-col justify-center items-start group">
                        
                        <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: url('{{ $ad['bg_pattern'] }}')"></div>

                        <div class="absolute -right-4 -top-4 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-700"></div>
                        
                        <div class="absolute right-6 bottom-4 transform group-hover:rotate-12 group-hover:scale-110 transition-transform duration-500">
                            {!! $ad['icon'] !!}
                        </div>

                        <div class="relative z-10 max-w-[65%] sm:max-w-[50%]">
                            <h3 class="text-xl md:text-3xl font-black leading-tight tracking-tight">
                                {{ $ad['title'] }}
                            </h3>
                            <p class="text-[11px] md:text-sm font-medium text-white/80 mt-1 md:mt-2 leading-tight">
                                {{ $ad['subtitle'] }}
                            </p>

                            <button class="mt-4 px-5 py-2 bg-white text-slate-900 text-[10px] md:text-xs font-bold rounded-xl shadow-lg hover:bg-slate-50 hover:-translate-y-0.5 active:scale-95 transition-all">
                                {{ $ad['cta'] }} <span class="ml-1">&rarr;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="swiper-pagination !-bottom-1"></div>

        <div class="swiper-button-next !w-10 !h-10 !bg-white !rounded-full !shadow-xl !text-luno-primary after:!text-sm hover:!scale-110 hidden lg:flex transition-all"></div>
        <div class="swiper-button-prev !w-10 !h-10 !bg-white !rounded-full !shadow-xl !text-luno-primary after:!text-sm hover:!scale-110 hidden lg:flex transition-all"></div>
    </div>
</div>

<style>
    /* Styling Swiper Pagination agar Luno banget */
    .swiper-pagination-bullet { @apply bg-slate-300 opacity-100 w-2 h-2 transition-all; }
    .swiper-pagination-bullet-active { @apply bg-luno-primary w-6 rounded-full; }
</style>