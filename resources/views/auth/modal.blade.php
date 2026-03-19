<div
    id="authModal"
    class="fixed inset-0 z-[100] {{ $errors->any() ? '' : 'hidden' }} transition-all duration-300"
>
    <div
        class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"
        onclick="closeLogin()">
    </div>

    <div class="relative min-h-screen flex items-center justify-center p-4 z-[110]">

        <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl overflow-hidden transform transition-all border border-slate-100">

            <div class="px-8 pt-10 pb-6 text-center relative">
                <button onclick="closeLogin()" class="absolute right-6 top-6 text-slate-400 hover:text-slate-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                <h2 id="authTitle" class="text-3xl font-black tracking-tighter text-slate-800">
                    Masuk ke <span class="text-luno-primary">LUNO<span class="text-amber-500">.</span></span>
                </h2>
                <p id="authSubtitle" class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-2">
                    Jual beli barang bekas jadi lebih mudah
                </p>
            </div>

            <div class="px-8 pb-10 space-y-6">

                {{-- ERROR ALERT --}}
                @if ($errors->any())
                    <div class="bg-rose-50 border border-rose-100 text-rose-600 text-[11px] font-bold rounded-2xl p-4 flex gap-3 items-start">
                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        <ul class="space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <a href="{{ route('google.redirect') }}"
                   class="w-full flex items-center justify-center gap-3 border-2 border-slate-100 rounded-2xl py-3.5 text-sm font-black text-slate-700 hover:bg-slate-50 hover:border-slate-200 transition-all active:scale-[0.98]">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5">
                    <span id="googleBtnText">Masuk dengan Google</span>
                </a>

                <div class="flex items-center gap-4">
                    <div class="flex-1 h-px bg-slate-100"></div>
                    <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Atau</span>
                    <div class="flex-1 h-px bg-slate-100"></div>
                </div>

                <div class="space-y-4">
                    <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf
                        <div class="space-y-3">
                            <div class="relative">
                                <input type="email" name="email" placeholder="Email Address" required
                                       class="w-full bg-slate-50 border-transparent focus:border-luno-primary focus:bg-white focus:ring-4 focus:ring-luno-primary/10 rounded-2xl px-5 py-3.5 text-sm font-medium transition-all outline-none">
                            </div>
                            <div class="relative">
                                <input type="password" name="password" placeholder="Password" required
                                       class="w-full bg-slate-50 border-transparent focus:border-luno-primary focus:bg-white focus:ring-4 focus:ring-luno-primary/10 rounded-2xl px-5 py-3.5 text-sm font-medium transition-all outline-none">
                            </div>
                        </div>
                        <button type="submit"
                                class="w-full bg-luno-primary text-white py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-luno-primary-dark shadow-xl shadow-blue-200 transition-all active:scale-[0.98]">
                            Masuk Sekarang
                        </button>
                    </form>

                    <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-4 hidden">
                        @csrf
                        <div class="space-y-3">
                            <input type="text" name="name" placeholder="Nama Lengkap" required
                                   class="w-full bg-slate-50 border-transparent focus:border-luno-primary focus:bg-white focus:ring-4 focus:ring-luno-primary/10 rounded-2xl px-5 py-3.5 text-sm font-medium transition-all outline-none">
                            <input type="email" name="email" placeholder="Email Address" required
                                   class="w-full bg-slate-50 border-transparent focus:border-luno-primary focus:bg-white focus:ring-4 focus:ring-luno-primary/10 rounded-2xl px-5 py-3.5 text-sm font-medium transition-all outline-none">
                            <input type="password" name="password" placeholder="Password" required
                                   class="w-full bg-slate-50 border-transparent focus:border-luno-primary focus:bg-white focus:ring-4 focus:ring-luno-primary/10 rounded-2xl px-5 py-3.5 text-sm font-medium transition-all outline-none">
                            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required
                                   class="w-full bg-slate-50 border-transparent focus:border-luno-primary focus:bg-white focus:ring-4 focus:ring-luno-primary/10 rounded-2xl px-5 py-3.5 text-sm font-medium transition-all outline-none">
                        </div>
                        <button type="submit"
                                class="w-full bg-luno-primary text-white py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-luno-primary-dark shadow-xl shadow-blue-200 transition-all active:scale-[0.98]">
                            Buat Akun Baru
                        </button>
                    </form>
                </div>

                <div class="pt-4 text-center">
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-tighter">
                        <span id="authSwitchText">Belum punya akun?</span>
                        <button type="button" onclick="switchAuthMode()" id="authBtnSwitch" class="text-luno-primary ml-1 hover:underline">
                            Daftar Sekarang
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let isLogin = true;

    function openLogin() {
        resetAuthModal();
        const modal = document.getElementById('authModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Stop scrolling
    }

    function closeLogin() {
        const modal = document.getElementById('authModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto'; // Re-enable scrolling
    }

    function resetAuthModal() {
        isLogin = true;
        loginMode();
    }

    function loginMode() {
        document.getElementById('loginForm').classList.remove('hidden');
        document.getElementById('registerForm').classList.add('hidden');
        document.getElementById('authTitle').innerHTML = 'Masuk ke <span class="text-luno-primary">LUNO<span class="text-amber-500">.</span></span>';
        document.getElementById('authSwitchText').innerText = 'Belum punya akun?';
        document.getElementById('authBtnSwitch').innerText = 'Daftar Sekarang';
        document.getElementById('googleBtnText').innerText = 'Masuk dengan Google';
        isLogin = true;
    }

    function registerMode() {
        document.getElementById('loginForm').classList.add('hidden');
        document.getElementById('registerForm').classList.remove('hidden');
        document.getElementById('authTitle').innerHTML = 'Daftar <span class="text-luno-primary">Baru<span class="text-amber-500">.</span></span>';
        document.getElementById('authSwitchText').innerText = 'Sudah punya akun?';
        document.getElementById('authBtnSwitch').innerText = 'Masuk Saja';
        document.getElementById('googleBtnText').innerText = 'Daftar dengan Google';
        isLogin = false;
    }

    function switchAuthMode() {
        isLogin ? registerMode() : loginMode();
    }

    @if ($errors->has('name') || $errors->has('password_confirmation'))
        document.addEventListener('DOMContentLoaded', () => {
            openLogin();
            registerMode();
        });
    @elseif ($errors->any())
         document.addEventListener('DOMContentLoaded', () => {
            openLogin();
        });
    @endif
</script>