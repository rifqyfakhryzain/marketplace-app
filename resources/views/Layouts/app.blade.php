<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUNO - Marketplace Thrifting Modern</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    {{-- Leaflet Map --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>

<body class="bg-luno-bg font-sans antialiased text-luno-dark min-h-screen flex flex-col">

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- MAIN CONTENT --}}
    <main class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-10">
        @yield('content')
    </main>

    {{-- AUTH MODAL (GLOBAL) --}}
    @include('auth.modal')

    {{-- CHAT POPUP & BUTTON --}}
    @auth
        @include('components.chat-popup')

        <button id="chat-button" type="button"
            class="fixed bottom-6 right-6 z-40 flex items-center justify-center gap-2 h-14 px-6 rounded-2xl bg-luno-primary text-white text-sm font-bold tracking-wide shadow-luno hover:bg-luno-primary-dark hover:-translate-y-1 active:scale-95 transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 10h8M8 14h6M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.8L3 20l1.8-4A7.96 7.96 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <span class="hidden sm:inline">Chat Penjual</span>
        </button>
    @endauth

    {{-- FOOTER --}}
    @include('components.footer')

    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/product-map.js') }}"></script>

    {{-- Swiper Init --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper(".adsSwiper", {
                slidesPerView: 1.2,
                spaceBetween: 12,
                centeredSlides: false,
                loop: true,
                autoplay: {
                    delay: 3000
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 24
                    }
                }
            });
        });
    </script>

</body>

</html>
