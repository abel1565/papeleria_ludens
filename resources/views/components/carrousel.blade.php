@props([
    'images' => [],   // arreglo de rutas
    'id' => 'carousel-' . uniqid()
])

<div id="{{ $id }}" class="relative max-w-7xl mx-auto" data-carousel="static">

    <!-- Carousel wrapper -->
    <div class="relative aspect-[2/1] overflow-hidden rounded-2xl">

        @foreach ($images as $index => $image)
            <div
                class="hidden duration-700 ease-in-out"
                data-carousel-item="{{ $index === 0 ? 'active' : '' }}"
            >
                <img
                    src="{{ asset($image) }}"
                    class="block w-full h-full object-cover"
                    alt="Slide {{ $index + 1 }}"
                >
            </div>
        @endforeach

    </div>

    <!-- Indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 space-x-3 bottom-4 left-1/2">
        @foreach ($images as $index => $image)
            <button
                class="w-3 h-3 rounded-full {{ $index === 0 ? 'bg-white' : 'bg-white/50 hover:bg-white' }}"
                data-carousel-slide-to="{{ $index }}"
            ></button>
        @endforeach
    </div>

    <!-- Controls -->
    <button type="button"
        class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4"
        data-carousel-prev>
        <span class="inline-flex w-10 h-10 items-center justify-center rounded-full bg-black/30 hover:bg-black/50">
            ‹
        </span>
    </button>

    <button type="button"
        class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4"
        data-carousel-next>
        <span class="inline-flex w-10 h-10 items-center justify-center rounded-full bg-black/30 hover:bg-black/50">
            ›
        </span>
    </button>

</div>
