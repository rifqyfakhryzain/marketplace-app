<div
    id="authModal"
    class="fixed inset-0 z-50 pointer-events-none {{ $errors->any() ? '' : 'hidden' }}"
>

    <!-- BACKDROP -->
    <div
        class="absolute inset-0 bg-black/50 pointer-events-auto"
        onclick="closeAuthModal()">
    </div>

    <!-- WRAPPER -->
    <div class="relative min-h-screen flex items-center justify-center p-4 z-50 pointer-events-auto">

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

                {{-- ERROR BREEZE --}}
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 text-sm rounded-lg p-3">
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- LOGIN -->
                <form
                    id="loginForm"
                    method="POST"
                    action="{{ route('login') }}"
                    class="space-y-3">
                    @csrf

                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        required
                        class="w-full border rounded-lg px-3 py-2">

                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                        class="w-full border rounded-lg px-3 py-2">

                    <button
                        type="submit"
                        class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition">
                        Masuk
                    </button>
                </form>

                <!-- REGISTER -->
                <form
                    id="registerForm"
                    method="POST"
                    action="{{ route('register') }}"
                    class="space-y-3 hidden">
                    @csrf

                    <input
                        type="text"
                        name="name"
                        placeholder="Nama Lengkap"
                        required
                        class="w-full border rounded-lg px-3 py-2">

                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        required
                        class="w-full border rounded-lg px-3 py-2">

                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                        class="w-full border rounded-lg px-3 py-2">

                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Konfirmasi Password"
                        required
                        class="w-full border rounded-lg px-3 py-2">

                    <button
                        type="submit"
                        class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition">
                        Daftar
                    </button>
                </form>

                <!-- SWITCH -->
<p class="text-sm text-center text-gray-600">
    <span id="authSwitchText">Belum punya akun?</span>
    <button
        type="button"
        id="authSwitchBtn"
        onclick="switchAuthMode()"
        class="text-blue-600 font-medium ml-1">
        Daftar
    </button>
</p>


                <p class="text-xs text-gray-400 mt-4 leading-relaxed text-center">
                    Kami tidak akan membagikan detail pribadi Anda dengan siapa pun.
                </p>
            </div>

            <!-- FOOTER -->
            <div class="px-6 pb-6">
                <button
                    type="button"
                    onclick="closeAuthModal()"
                    class="w-full text-sm text-gray-500 hover:text-gray-700">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    let isLogin = true;

    function openAuthModal() {
        resetAuthModal();
        document.getElementById('authModal').classList.remove('hidden');
    }

    function closeAuthModal() {
        document.getElementById('authModal').classList.add('hidden');
    }

    function resetAuthModal() {
        isLogin = true;

        document.getElementById('loginForm').classList.remove('hidden');
        document.getElementById('registerForm').classList.add('hidden');

        document.getElementById('authTitle').innerText = 'Masuk ke LUNO';
        document.getElementById('authSwitchText').innerText = 'Belum punya akun?';
        document.getElementById('authSwitchBtn').innerText = 'Daftar';
    }

    function switchAuthMode() {
        const switchText = document.getElementById('authSwitchText');
        const switchBtn  = document.getElementById('authSwitchBtn');

        if (isLogin) {
            // KE REGISTER
            document.getElementById('loginForm').classList.add('hidden');
            document.getElementById('registerForm').classList.remove('hidden');

            document.getElementById('authTitle').innerText = 'Daftar Akun Baru';
            switchText.innerText = 'Sudah punya akun?';
            switchBtn.innerText = 'Masuk';

            isLogin = false;
        } else {
            // KEMBALI KE LOGIN
            resetAuthModal();
        }
    }

    // AUTO OPEN & SWITCH JIKA ERROR REGISTER
    @if ($errors->has('name') || $errors->has('password_confirmation'))
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('authModal').classList.remove('hidden');
            switchAuthMode();
        });
    @endif
</script>

