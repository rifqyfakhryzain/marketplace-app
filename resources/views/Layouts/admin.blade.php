<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex">

        {{-- SIDEBAR --}}
        <aside class="w-64 bg-white shadow-lg flex flex-col">

            {{-- HEADER --}}
            <div class="p-6 border-b">
                <h2 class="text-xl font-bold text-indigo-600">
                    Admin Panel
                </h2>
            </div>

            {{-- PROFILE ADMIN --}}
            <div class="p-6 border-b flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center font-bold text-indigo-600">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <p class="font-semibold text-sm">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-xs text-gray-500">
                        Administrator
                    </p>
                </div>
            </div>

            {{-- MENU --}}
            <nav class="flex-1 p-4 space-y-2">

                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-2 rounded transition
               {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'hover:bg-gray-100' }}">
                    📊 Dashboard
                </a>

                <a href="{{ route('admin.escrows.index') }}"
                    class="block px-4 py-2 rounded transition
               {{ request()->routeIs('admin.escrows.*') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'hover:bg-gray-100' }}">
                    💳 Escrow
                </a>

                <a href="{{ route('admin.withdraw.index') }}"
                    class="block px-4 py-2 rounded transition
               {{ request()->routeIs('admin.withdraw.*') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'hover:bg-gray-100' }}">
                    💰 Withdraw
                </a>

            </nav>

            {{-- LOGOUT BUTTON --}}
            <div class="p-4 border-t">
                <form method="POST" action="{{ route('logout') }}"
                    onsubmit="return confirm('Yakin ingin logout dari Admin Panel?')">
                    @csrf
                    <button class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600 transition">
                        🚪 Logout
                    </button>
                </form>

            </div>

        </aside>

        {{-- CONTENT --}}
        <main class="flex-1 p-8">
            @yield('content')
        </main>

    </div>

</body>

</html>
