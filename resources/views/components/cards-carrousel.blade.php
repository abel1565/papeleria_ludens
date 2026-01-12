@props([
    'title' => 'Los mejores precios en papelería',
    'items' => [],
])

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <section>
        <!-- Título -->
        <div class="py-12">
            <div class="shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-4xl font-semibold">
                    {{ __($title) }}
                </div>
            </div>
        </div>

        <div class="relative group">

            <!-- Flechas -->
            <button
                data-prev
                aria-label="Previous"
                class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full shadow-md p-2 opacity-50 group-hover:opacity-100 transition">
                ‹
            </button>

            <button
                data-next
                aria-label="Next"
                class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full shadow-md p-2 opacity-50 group-hover:opacity-100 transition">
                ›
            </button>

            <!-- Carrusel -->
            <div
                data-carousel
                class="flex gap-6 overflow-x-auto scrollbar-hide scroll-smooth snap-x snap-mandatory px-2">

                @foreach ($items as $item)
                <article
                    class="flex-shrink-0 snap-center flex flex-col
                        w-flex
                        rounded-2xl shadow-lg  overflow-hidden">

                    <!-- CONTENEDOR de imagen -->
                    <div class="w-flex  flex items-center justify-center ">
                        <img
                            src="{{ $item['image'] }}"
                            
                            class="max-w-full max-h-full object-contain">
                    </div>


</article>
                @endforeach

            </div>
        </div>
    </section>

</div>

{{-- JS mínimo encapsulado --}}
<script>
    (() => {
        const root = document.currentScript.closest('div');
        const carousel = root.querySelector('[data-carousel]');
        const prev = root.querySelector('[data-prev]');
        const next = root.querySelector('[data-next]');

        const scrollAmount = carousel.offsetWidth * 0.8;

        prev.addEventListener('click', () => {
            carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });

        next.addEventListener('click', () => {
            carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });
    })();
</script>
