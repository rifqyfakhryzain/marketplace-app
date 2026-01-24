<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>LUNO</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        0: { slidesPerView: 1.2 },
        640: { slidesPerView: 2 },
        1024: { slidesPerView: 3 }
    }
});
</script>

@include('components.footer')

</body>
</html>
