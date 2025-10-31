<x-app-layout>
<x-slot name="header">
    <div class="flex flex-row justify-center space-x-4">
        <div class="bg-yellow-300 flex items-center gap-2 px-3 py-2 rounded">
            <img src="{{ asset('/mercadolibre.svg') }}" 
                class="h-6 w-auto">
            <a href="https://www.mercadolibre.com.mx/pagina/dnovacpapelera#from=share_eshop">Comprar en Mercado Libre</a>
        </div>
        <div class="bg-yellow-300 flex items-center gap-2 px-3 py-2 rounded">
            <img src="{{ asset('/mercadolibre.svg') }}" 
                class="h-6 w-auto">
            <a href="https://www.mercadolibre.com.mx/pagina/novedacticfabricantes">Comprar en Mercado Libre</a>
        </div>

    </div>
</x-slot>
<body class="bg-gray-100">

    <div id="indicators-carousel" class="relative max-w-7xl mx-auto" data-carousel="static">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                <img src="{{ asset('/imagen carrusel- dasboard1011-1200x600 (1).png')}}" 
                     class="absolute block w-full h-full object-cover" 
                     alt="">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('/imagen carrusel- dasboard1011-1200x600.png')}}" 
                     class="absolute block w-full h-full object-cover" 
                     alt="Producto 2">
            </div>
            <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                <img src="{{ asset('/imagen carrusel- dasboard1011-1200x600 (1).png')}}" 
                     class="absolute block w-full h-full object-cover" 
                     alt="">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('/imagen carrusel- dasboard1011-1200x600.png')}}" 
                     class="absolute block w-full h-full object-cover" 
                     alt="Producto 2">
            </div>
        </div>

        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 space-x-3 bottom-5 left-1/2">
            <button type="button" class="w-3 h-3 rounded-full bg-white" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
        </div>

        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30 group-hover:bg-black/50">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 6 10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30 group-hover:bg-black/50">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 6 10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <livewire:layout.cards-carrousel/>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 text-4xl font-semibold">
            {{ __(" Back To Scool ") }}
          </div>
        </div>
      </div>
    </div>

    <div class="hidden duration-700 ease-in-out" >
                <img src="https://picsum.photos/id/1011/1200/600" 
                     class="absolute block w-full h-full object-cover" 
                     alt="Producto 1">
    </div>

</body>

<livewire:layout.footer/>

    
</x-app-layout>
