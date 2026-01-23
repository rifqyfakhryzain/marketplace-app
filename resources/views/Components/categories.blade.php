<div class="max-w-7xl mx-auto px-6 mt-16 flex justify-center">

    <div class="overflow-x-auto">
        <div class="flex gap-6 w-max">

            @php
                $categories = [
                    ['name' => 'Elektronik', 'img' => 'elektronik.png'],
                    ['name' => 'Rumah', 'img' => 'rumah.png'],
                    ['name' => 'Otomotif', 'img' => 'otomotif.png'],
                    ['name' => 'Olahraga', 'img' => 'olahraga.png'],
                    ['name' => 'Musik', 'img' => 'musik.png'],
                    ['name' => 'Fashion', 'img' => 'fashion.png'],
                    ['name' => 'Hobi', 'img' => 'hobi.png'],
                ];
            @endphp

            @foreach ($categories as $cat)
                <div class="w-[88px] shrink-0 text-center">

                    <!-- ICON IMAGE -->
                    <div class="w-[40px] h-[40px]
                                mx-auto
                                bg-gray-100
                                rounded-2xl
                                flex items-center justify-center
                                overflow-hidden
                                hover:bg-gray-200
                                transition cursor-pointer">

                        <img
                            src="{{ asset('images/categories/' . $cat['img']) }}"
                            alt="{{ $cat['name'] }}"
                            class="w-10 h-10 object-contain"
                        >
                    </div>

                    <!-- TEXT -->
                    <p class="text-xs mt-2">
                        {{ $cat['name'] }}
                    </p>
                </div>
            @endforeach

        </div>
    </div>

</div>
