<div class="max-w-7xl mx-auto px-6 mt-8 flex justify-center">

    <div class="overflow-x-auto py-4 hide-scroll">
        <div class="flex gap-4 w-max px-2">

            @php
                // SAYA MENGGANTI SEMUA ICON MENJADI TIPE "SOLID" (ISI PENUH)
                // Agar terlihat bagus saat diberi warna.
                $categories = [
                    [
                        'name' => 'Elektronik',
                        // Icon CPU/Chip Solid
                        'icon' =>
                            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7"><path fill-rule="evenodd" d="M3 6a3 3 0 013-3h12a3 3 0 013 3v12a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm14.25 6a.75.75 0 01-.75.75h-11.5a.75.75 0 010-1.5h11.5a.75.75 0 01.75.75zm0 4.5a.75.75 0 01-.75.75h-11.5a.75.75 0 010-1.5h11.5a.75.75 0 01.75.75z" clip-rule="evenodd" /></svg>',
                    ],
                    [
                        'name' => 'Rumah',
                        // Icon Rumah Solid
                        'icon' =>
                            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7"><path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" /><path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75v4.5a.75.75 0 01-.75.75H3.75a1.875 1.875 0 01-1.875-1.875V13.677c.03-.028.06-.057.091-.086L12 5.432z" /></svg>',
                    ],
                    [
                        'name' => 'Otomotif',
                        // Icon Mobil Solid
                        'icon' =>
                            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7"><path d="M3.375 4.5C2.339 4.5 1.5 5.339 1.5 6.375V13.5h1.5V6.375c0-.207.168-.375.375-.375h17.25c.207 0 .375.168.375.375v7.125h1.5V6.375c0-1.036-.839-1.875-1.875-1.875H3.375zM1.5 15v2.25c0 1.036.839 1.875 1.875 1.875h17.25A1.875 1.875 0 0022.5 17.25V15h-21z" /><path d="M3 16.5a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM18 16.5a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" /></svg>',
                    ],
                    [
                        'name' => 'Olahraga',
                        // Icon Trofi Solid
                        'icon' =>
                            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7"><path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.352-.272-2.635-.759-3.805a.75.75 0 00-.724-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" /></svg>',
                    ],
                    [
                        'name' => 'Musik',
                        // Icon Nada Musik Solid
                        'icon' =>
                            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7"><path fill-rule="evenodd" d="M19.952 1.651a.75.75 0 01.298.599V16.303a3 3 0 01-2.176 2.886 3 3 0 11-3.823-2.886V6.044l-8.31 2.375v9.33c0 1.382-1.006 2.61-2.367 2.89a3 3 0 11-3.383-2.89V8.056a.75.75 0 01.545-.721l10.5-3a.75.75 0 01.916.54l.8 2.8a.75.75 0 101.443-.412l-.8-2.8a2.25 2.25 0 00-2.748-1.62l-8.31 2.374-.626-2.19a.75.75 0 01.545-.721l10.5-3a.75.75 0 01.916.54l.8 2.8a.75.75 0 101.443-.412l-.8-2.8a2.25 2.25 0 00-2.748-1.62l-8.31 2.374-.626-2.19a2.25 2.25 0 011.636-2.804l10.5-3a2.25 2.25 0 012.748 1.62z" clip-rule="evenodd" /></svg>',
                    ],
                    [
                        'name' => 'Fashion',
                        // Icon Tas Belanja Solid
                        'icon' =>
                            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7"><path fill-rule="evenodd" d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 004.25 22.5h15.5a1.875 1.875 0 001.865-2.071l-1.263-12a1.875 1.875 0 00-1.865-1.679H16.5V6a4.5 4.5 0 10-9 0zM12 3a3 3 0 00-3 3v.75h6V6a3 3 0 00-3-3zm-3 8.25a3 3 0 106 0v-.75a.75.75 0 011.5 0v.75a4.5 4.5 0 11-9 0v-.75a.75.75 0 011.5 0v.75z" clip-rule="evenodd" /></svg>',
                    ],
                    [
                        'name' => 'Hobi',
                        // Icon Puzzle / Hati Solid
                        'icon' =>
                            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7"><path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.75 3c1.99 0 3.751.984 4.822 2.483C13.699 3.984 15.46 3 17.45 3c3.036 0 5.5 2.322 5.5 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" /></svg>',
                    ],
                ];
            @endphp

            @foreach ($categories as $cat)
                <div class="group flex flex-col items-center w-[80px] shrink-0 cursor-pointer">

                    <div
                        class="w-[58px] h-[58px]
                                flex items-center justify-center
                                rounded-2xl
                                shadow-sm
                                border
                                transition-all duration-300 ease-in-out
                                transform group-hover:-translate-y-1
                                
                                /* STATE NORMAL: */
                                bg-blue-50         /* Background biru sangat muda */
                                border-blue-100    /* Border biru muda */
                                text-blue-600      /* Icon warna biru tema */

                                /* STATE HOVER: */
                                group-hover:bg-blue-600    /* Background jadi biru tema */
                                group-hover:border-blue-600 /* Border nyatu sama background */
                                group-hover:text-white     /* Icon jadi putih agar kontras */
                                group-hover:shadow-md
                                ">

                        {!! $cat['icon'] !!}

                    </div>

                    <p
                        class="text-xs font-medium text-gray-600 mt-2 text-center group-hover:text-blue-600 transition-colors">
                        {{ $cat['name'] }}
                    </p>
                </div>
            @endforeach

        </div>
    </div>
</div>
