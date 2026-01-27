<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">

            <div class="flex items-center gap-4">
                <img
                    src="{{ $user->avatar ?? '/img/default-avatar.png' }}"
                    class="w-20 h-20 rounded-full object-cover"
                >

                <div>
                    <h1 class="text-xl font-semibold">{{ $user->name }}</h1>
                    <p class="text-sm text-gray-500">@{{ $user->username }}</p>
                </div>
            </div>

            <div class="mt-6">
                <h2 class="font-semibold mb-2">About</h2>
                <p class="text-gray-700">
                    {{ $user->bio ?? 'User has no bio yet.' }}
                </p>
            </div>

            <div class="mt-6 text-sm text-gray-500">
                Joined {{ $user->created_at->format('F Y') }}
            </div>

        </div>
    </div>
</x-app-layout>
