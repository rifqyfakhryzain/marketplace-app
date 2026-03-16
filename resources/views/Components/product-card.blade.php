@isset($product)
<div class="{{ $horizontal ?? false ? 'w-[160px] sm:w-56 shrink-0' : 'w-full' }}">
    <a href="{{ route('products.show', $product->id) }}" 
       class="group block h-full">
        
        <div class="bg-white rounded-[1.5rem] p-2 sm:p-3 border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-2 transition-all duration-500 h-full flex flex-col relative">
            
            <div class="relative aspect-square overflow-hidden rounded-[1.2rem] bg-slate-50">
                <img src="{{ $product->images->first() 
                    ? asset('storage/' . $product->images->first()->image_path) 
                    : asset('images/placeholder-product.jpg') }}" 
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                    alt="{{ $product->nama_barang }}">
                
                <div class="absolute top-2 left-2 flex gap-1">
                    @if($product->kondisi == 'Baru')
                    <span class="bg-emerald-500 text-white text-[9px] font-black px-2 py-1 rounded-lg uppercase tracking-tighter shadow-sm">
                        Baru
                    </span>
                    @else
                    <span class="bg-amber-500 text-white text-[9px] font-black px-2 py-1 rounded-lg uppercase tracking-tighter shadow-sm">
                        Second
                    </span>
                    @endif
                </div>

                <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <div class="bg-white/90 backdrop-blur-sm p-1.5 rounded-full text-rose-500 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="mt-3 px-1 flex flex-col flex-grow">
                <h3 class="text-xs sm:text-sm font-bold text-slate-700 line-clamp-2 leading-tight group-hover:text-luno-primary transition-colors duration-300">
                    {{ $product->nama_barang }}
                </h3>

                <div class="mt-auto pt-2">
                    <p class="text-sm sm:text-base font-black text-luno-primary tracking-tight">
                        Rp{{ number_format($product->harga, 0, ',', '.') }}
                    </p>
                    
                    <div class="flex items-center gap-1 mt-1.5 text-slate-400 border-t border-slate-50 pt-2">
                        <div class="bg-slate-100 p-0.5 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-slate-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-[10px] truncate font-bold text-slate-400 uppercase tracking-tight">
                            {{ $product->penjual->alamat ?? 'Indonesia' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
@endisset