<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>LUNO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
</head>

{{-- ⬇️ TAMBAH CLASS DI SINI --}}
<body class="bg-gray-50 min-h-screen flex flex-col">

@include('components.navbar')

{{-- ⬇️ TAMBAH class="flex-1" --}}
<main class="flex-1">
    @yield('content')
</main>

@include('auth.modal')

<script>
function openLogin() {
    document.getElementById('authModal').classList.remove('hidden')
}
function closeLogin() {
    document.getElementById('authModal').classList.add('hidden')
}
</script>

<script>
let authMode = 'login'; // login | register

function openLogin() {
    authMode = 'login';
    updateAuthUI();
    document.getElementById('authModal').classList.remove('hidden');
}

function closeLogin() {
    document.getElementById('authModal').classList.add('hidden');
}

function switchAuthMode() {
    authMode = authMode === 'login' ? 'register' : 'login';
    updateAuthUI();
}

function updateAuthUI() {
    const title = document.getElementById('authTitle');
    const subtitle = document.getElementById('authSubtitle');
    const primaryBtn = document.getElementById('authPrimaryBtn');
    const switchText = document.getElementById('authSwitchText');
    const switchBtn = document.getElementById('authSwitchBtn');

    if (!title || !primaryBtn) {
        console.error('Auth modal elements not found');
        return;
    }

    if (authMode === 'login') {
        title.innerText = 'Masuk ke LUNO';
        subtitle.innerText = 'Jual beli barang bekas jadi lebih mudah';
        primaryBtn.innerText = 'Masuk';
        switchText.innerText = 'Belum punya akun?';
        switchBtn.innerText = 'Daftar';
    } else {
        title.innerText = 'Daftar Akun LUNO';
        subtitle.innerText = 'Buat akun untuk mulai jual beli';
        primaryBtn.innerText = 'Daftar';
        switchText.innerText = 'Sudah punya akun?';
        switchBtn.innerText = 'Masuk';
    }
}
</script>


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
