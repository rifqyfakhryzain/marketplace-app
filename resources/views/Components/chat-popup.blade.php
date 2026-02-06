<!-- CHAT POPUP OVERLAY -->
<div id="chat-popup" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/40">

    <!-- CHAT CONTAINER -->
    <div class="w-[900px] h-[520px] bg-white rounded-xl shadow-2xl flex overflow-hidden">

        <!-- LEFT: CHAT LIST -->
        <div class="w-[35%] border-r bg-gray-50 flex flex-col">

            <!-- LEFT HEADER -->
            <div class="h-14 flex items-center px-4 font-semibold bg-blue-600 text-white">
                CHAT
            </div>

            <!-- EMPTY STATE (LIST) -->
            <div class="flex-1 flex items-center justify-center text-sm text-gray-400">
                Belum ada percakapan
            </div>

            <!-- LEFT FOOTER -->
            <div class="h-10 flex items-center justify-center text-xs text-gray-400 border-t">
                Chat by LUNO
            </div>
        </div>

        <!-- RIGHT: CHAT ROOM -->
        <div class="flex-1 flex flex-col">

            <!-- RIGHT HEADER -->
            <div class="h-14 border-b flex items-center px-4 font-semibold text-gray-500">
                Pilih chat untuk mulai
            </div>

            <!-- EMPTY CHAT -->
            <div class="flex-1 flex items-center justify-center text-sm text-gray-400">
                Belum ada pesan
            </div>

            <!-- INPUT (DISABLED) -->
            <div class="h-14 border-t flex items-center px-3 gap-2 bg-gray-50">
                <input type="text" disabled placeholder="Pilih chat terlebih dahulu"
                    class="flex-1 border rounded-lg px-3 py-2 text-sm bg-gray-100 cursor-not-allowed" />
                <button disabled class="bg-gray-300 text-white px-4 py-2 rounded-lg text-sm cursor-not-allowed">
                    Kirim
                </button>
            </div>

        </div>
    </div>
</div>
