<div id="authModal" class="fixed inset-0 hidden z-50">

    <!-- BACKDROP -->
    <div class="absolute inset-0 bg-black/50" onclick="closeLogin()"></div>

    <!-- MODAL -->
    <div class="relative min-h-screen flex items-center justify-center p-4">

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
            <div class="px-6 py-6 space-y-4 text-center">

                <!-- BUTTON PRIMARY -->
                <button
                    id="authPrimaryBtn"
                    class="w-full bg-blue-600 text-white
                           py-2.5 rounded-lg
                           font-semibold
                           hover:bg-blue-700 transition">
                    Masuk
                </button>

                <!-- SWITCH TEXT -->
                <p class="text-sm text-gray-600">
                    <span id="authSwitchText">Belum punya akun?</span>
                    <button
                        type="button"
                        id="authSwitchBtn"
                        onclick="switchAuthMode()"
                        class="text-blue-600 font-medium ml-1">
                        Daftar
                    </button>
                </p>


                <!-- PRIVACY -->
                <p class="text-xs text-gray-400 mt-4 leading-relaxed">
                    Kami tidak akan membagikan detail pribadi Anda
                    dengan siapa pun.
                </p>

            </div>

            <!-- FOOTER -->
            <div class="px-6 pb-6">
                <button
                    onclick="closeLogin()"
                    class="w-full text-sm text-gray-500 hover:text-gray-700">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>
