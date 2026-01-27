<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>LUNO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    @include('components.navbar')

    <main class="flex-1">
        @yield('content')
    </main>

    {{-- AUTH MODAL (GLOBAL) --}}
    @include('auth.modal')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        new Swiper(".adsSwiper", {
            slidesPerView: 3,
            spaceBetween: 16,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                0: {
                    slidesPerView: 1.2
                },
                640: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                }
            }
        });
    </script>

    {{-- CHAT POPUP (GLOBAL) --}}
    @auth
        @include('Components.chat-popup')
    @endauth


    @auth
    <button
        id="chat-button"
        type="button"
        class="
            fixed bottom-6 right-6 z-40
            flex items-center justify-center gap-2

            h-14 px-6
            rounded-xl

            bg-blue-600 text-white
            text-sm font-semibold tracking-wide

            shadow-lg shadow-blue-600/30
            hover:bg-blue-700 hover:shadow-xl
            active:scale-95

            transition-all duration-200
        "
    >
        <!-- ICON -->
        <svg xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M8 10h8M8 14h6M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.8L3 20l1.8-4A7.96 7.96 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>

        <!-- TEXT -->
        <span class="leading-none">Chat</span>
    </button>
    @endauth


    @include('components.footer')

</body>

</html>