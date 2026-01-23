<div class="max-w-7xl mx-auto px-6 mt-6 relative">

    <!-- FADE KIRI -->
    <div class="pointer-events-none absolute left-0 top-0
                w-12 h-full z-10
                bg-gradient-to-r from-white to-transparent">
    </div>

    <!-- FADE KANAN -->
    <div class="pointer-events-none absolute right-0 top-0
                w-12 h-full z-10
                bg-gradient-to-l from-white to-transparent">
    </div>

    <div class="swiper adsSwiper">
        <div class="swiper-wrapper">

            @for ($i = 1; $i <= 5; $i++)
                <div class="swiper-slide">
                    <div class="bg-blue-600 text-white
                                h-[180px] rounded-xl
                                p-4 flex flex-col justify-center">
                        <h3 class="font-semibold">
                            Iklan Dummy {{ $i }}
                        </h3>
                        <p class="text-xs mt-1">
                            Promo menarik hari ini
                        </p>
                    </div>
                </div>
            @endfor

        </div>

        <!-- PANAH -->
        <div class="swiper-button-next text-gray-600"></div>
        <div class="swiper-button-prev text-gray-600"></div>
    </div>

</div>
