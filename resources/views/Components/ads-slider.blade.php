<div class="max-w-7xl mx-auto px-6 mt-6 relative group">

    <div class="pointer-events-none absolute left-6 top-0 bottom-0
                w-16 z-10
                bg-gradient-to-r from-white via-white/80 to-transparent">
    </div>

    <div class="pointer-events-none absolute right-6 top-0 bottom-0
                w-16 z-10
                bg-gradient-to-l from-white via-white/80 to-transparent">
    </div>

    <div class="swiper adsSwiper !pb-8"> <div class="swiper-wrapper">

            @php
                // DATA DUMMY IKLAN KHUSUS MARKETPLACE BEKAS
                $ads = [
                    [
                        'title' => 'Gudang Penuh?',
                        'subtitle' => 'Jual barang bekasmu jadi cuan instan hari ini!',
                        'cta' => 'Mulai Jual',
                        'color' => 'bg-gradient-to-r from-blue-600 to-indigo-700',
                        'icon' => '<svg class="w-24 h-24 text-white/20 rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.15-1.46-3.27-3.4h1.96c.1 1.05 1.18 1.91 2.53 1.91 1.38 0 2.53-.83 2.53-1.94 0-2.4-3.55-2.5-3.55-5.38 0-1.5 1.25-2.73 2.8-3.03V4.5h2.67v1.97c1.37.28 2.5 1.25 2.61 2.78h-1.96c-.12-.83-1.03-1.45-2.08-1.45-1.06 0-1.85.81-1.85 1.88 0 2.45 3.55 2.44 3.55 5.31 0 1.6-1.3 2.92-2.92 3.1z"/></svg>', // Icon Uang
                    ],
                    [
                        'title' => 'Gadget Impian',
                        'subtitle' => 'Upgrade HP gak perlu mahal. Cek koleksi second like new.',
                        'cta' => 'Cari Gadget',
                        'color' => 'bg-gradient-to-r from-cyan-500 to-blue-600',
                        'icon' => '<svg class="w-24 h-24 text-white/20 -rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M17 1.01L7 1c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V3c0-1.1-.9-1.99-2-1.99zM17 19H7V5h10v14z"/></svg>', // Icon HP
                    ],
                    [
                        'title' => 'Thrifting Style',
                        'subtitle' => 'Outfit branded harga miring. Tampil keren hemat budget.',
                        'cta' => 'Lihat Fashion',
                        'color' => 'bg-gradient-to-r from-slate-700 to-gray-900',
                        'icon' => '<svg class="w-24 h-24 text-white/20 rotate-6" fill="currentColor" viewBox="0 0 24 24"><path d="M21.96 6.01c-.13-.35-.29-.68-.48-.99-.54-.88-1.28-1.61-2.17-2.16l-.01-.01c-.34-.19-.7-.34-1.07-.46-.35-.11-.72-.18-1.09-.2-.05 0-.1 0-.15 0H7.01c-.05 0-.1 0-.15.01-.37.02-.73.08-1.09.2-.38.12-.73.27-1.07.46l-.01.01c-.88.54-1.63 1.28-2.17 2.16-.19.3-.35.63-.48.99-.12.37-.2.75-.22 1.15v.07c0 .04 0 .09 0 .13v9.06c0 2.21 1.79 4 4 4h12.34c2.21 0 4-1.79 4-4V7.29c0-.04 0-.09 0-.13v-.06c-.02-.4-.1-.79-.22-1.09zM15.5 12c-1.93 0-3.5-1.57-3.5-3.5S13.57 5 15.5 5 19 6.57 19 8.5 17.43 12 15.5 12z"/></svg>', // Icon Baju
                    ],
                     [
                        'title' => 'Aman & Nyaman',
                        'subtitle' => 'Rekber aktif! Transaksi aman, hati tenang, barang sampai.',
                        'cta' => 'Pelajari',
                        'color' => 'bg-gradient-to-r from-emerald-500 to-teal-600',
                        'icon' => '<svg class="w-24 h-24 text-white/20 -rotate-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>', // Icon Shield
                    ],
                ];
            @endphp

            @foreach ($ads as $ad)
                <div class="swiper-slide p-1"> <div class="{{ $ad['color'] }} text-white
                                h-[180px] rounded-2xl
                                px-8 py-6
                                relative overflow-hidden shadow-lg
                                flex flex-col justify-center items-start">
                        
                        <div class="absolute -right-6 -top-6 w-32 h-32 bg-white/10 rounded-full blur-xl"></div>
                        <div class="absolute right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-xl"></div>

                        <div class="absolute right-4 bottom-4">
                            {!! $ad['icon'] !!}
                        </div>

                        <div class="relative z-10 max-w-[70%]">
                            <h3 class="text-2xl font-bold leading-tight drop-shadow-md">
                                {{ $ad['title'] }}
                            </h3>
                            <p class="text-sm font-medium text-blue-50 mt-2 leading-relaxed opacity-90">
                                {{ $ad['subtitle'] }}
                            </p>
                            
                            <button class="mt-4 px-4 py-2 bg-white text-blue-900 text-xs font-bold rounded-full shadow-md hover:bg-gray-100 hover:scale-105 transition-transform duration-200">
                                {{ $ad['cta'] }} &rarr;
                            </button>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>

        <div class="swiper-button-next !w-8 !h-8 !bg-white/90 !rounded-full !shadow-md !text-blue-600 after:!text-xs hover:!bg-white hidden md:flex mr-2"></div>
        <div class="swiper-button-prev !w-8 !h-8 !bg-white/90 !rounded-full !shadow-md !text-blue-600 after:!text-xs hover:!bg-white hidden md:flex ml-2"></div>
    </div>

</div>