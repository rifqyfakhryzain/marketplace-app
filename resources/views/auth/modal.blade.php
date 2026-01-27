<div
    id="authModal"
    class="fixed inset-0 z-50 {{ $errors->any() ? '' : 'hidden' }}"
>

    <!-- BACKDROP -->
    <div
        class="absolute inset-0 bg-black/50"
        onclick="closeLogin()">
    </div>

    <!-- WRAPPER -->
    <div class="relative min-h-screen flex items-center justify-center p-4 z-50">

        <!-- CARD -->
        <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden">

            <!-- HEADER -->
            <div class="px-6 pt-6 pb-4 border-b text-center">
                <h2 id="authTitle" class="text-xl font-bold">
                    Masuk ke LUNO
                </h2>
                <p id="authSubtitle" class="text-sm text-gray-500 mt-1">
                    Jual beli barang bekas jadi lebih mudah
                </p>
            </div>

            <!-- BODY -->
            <div class="px-6 py-6 space-y-4">

                {{-- ERROR --}}
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 text-sm rounded-lg p-3">
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- GOOGLE -->
                <a href="{{ route('google.redirect') }}"
                   class="w-full flex items-center justify-center gap-3
                          border border-gray-300 rounded-lg
                          py-2.5 text-sm font-semibold
                          hover:bg-gray-50 transition">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5">
                    <span id="googleBtnText">Masuk dengan Google</span>
                </a>

                <!-- DIVIDER -->
                <div class="flex items-center gap-3">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-xs text-gray-400">atau</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <!-- LOGIN FORM -->
                <form
                    id="loginForm"
                    method="POST"
                    action="{{ route('login') }}"
                    class="space-y-3">
                    @csrf

                    <input type="email" name="email" placeholder="Email" required
                           class="w-full border rounded-lg px-3 py-2">

                    <input type="password" name="password" placeholder="Password" required
                           class="w-full border rounded-lg px-3 py-2">

                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-semibold hover:bg-blue-700">
                        Masuk
                    </button>
                </form>

                <!-- REGISTER FORM -->
                <form
                    id="registerForm"
                    method="POST"
                    action="{{ route('register') }}"
                    class="space-y-3 hidden">
                    @csrf

                    <input type="text" name="name" placeholder="Nama Lengkap" required
                           class="w-full border rounded-lg px-3 py-2">

                    <input type="email" name="email" placeholder="Email" required
                           class="w-full border rounded-lg px-3 py-2">

                    <input type="password" name="password" placeholder="Password" required
                           class="w-full border rounded-lg px-3 py-2">

                    <input type="password" name="password_confirmation"
                           placeholder="Konfirmasi Password" required
                           class="w-full border rounded-lg px-3 py-2">

                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-semibold hover:bg-blue-700">
                        Daftar
                    </button>
                </form>

                <!-- SWITCH -->
                <p class="text-sm text-center text-gray-600">
                    <span id="authSwitchText">Belum punya akun?</span>
                    <button
                        type="button"
                        onclick="switchAuthMode()"
                        class="text-blue-600 font-medium ml-1">
                        Daftar
                    </button>
                </p>

                <!-- PRIVACY -->
                <p class="text-xs text-gray-400 text-center leading-relaxed">
                    Kami tidak akan membagikan detail pribadi Anda kepada siapa pun.
                </p>

            </div>

            <!-- FOOTER -->
            <div class="px-6 pb-6">
                <button
                    type="button"
                    onclick="closeLogin()"
                    class="w-full text-sm text-gray-500 hover:text-gray-700">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    let isLogin = true;

    function openLogin() {
        resetAuthModal();
        document.getElementById('authModal').classList.remove('hidden');
    }

    function closeLogin() {
        document.getElementById('authModal').classList.add('hidden');
    }

    function resetAuthModal() {
        isLogin = true;
        loginMode();
    }

    function loginMode() {
        document.getElementById('loginForm').classList.remove('hidden');
        document.getElementById('registerForm').classList.add('hidden');
        document.getElementById('authTitle').innerText = 'Masuk ke LUNO';
        document.getElementById('authSwitchText').innerText = 'Belum punya akun?';
        document.getElementById('googleBtnText').innerText = 'Masuk dengan Google';
        isLogin = true;
    }

    function registerMode() {
        document.getElementById('loginForm').classList.add('hidden');
        document.getElementById('registerForm').classList.remove('hidden');
        document.getElementById('authTitle').innerText = 'Daftar Akun Baru';
        document.getElementById('authSwitchText').innerText = 'Sudah punya akun?';
        document.getElementById('googleBtnText').innerText = 'Daftar dengan Google';
        isLogin = false;
    }

    function switchAuthMode() {
        isLogin ? registerMode() : loginMode();
    }

    // AUTO OPEN REGISTER MODE JIKA ERROR REGISTER
    @if ($errors->has('name') || $errors->has('password_confirmation'))
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('authModal').classList.remove('hidden');
            registerMode();
        });
    @endif
</script>
