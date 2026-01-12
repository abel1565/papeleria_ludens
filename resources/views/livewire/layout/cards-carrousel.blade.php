<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

  <section>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 text-4xl font-semibold">
            {{ __(" Los mejores precios en papelería ") }}
          </div>
        </div>
      </div>
    </div>

    <div class="relative group">
      <!-- Flechas de navegación -->
      <button id="prev" aria-label="Previous" class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full shadow-md p-2 opacity-50 group-hover:opacity-100 transition">
        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6" /></svg>
      </button>
      <button id="next" aria-label="Next" class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full shadow-md p-2 opacity-50 group-hover:opacity-100 transition">
        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6" /></svg>
      </button>

      <!-- Contenedor del carrusel -->
      <div id="carousel" class="flex space-x-6 overflow-x-auto scrollbar-hide scroll-smooth snap-x snap-mandatory px-2">
        
        <!-- Card 1 -->
        <article class="flex-shrink-0 snap-center w-flex rounded-2xl shadow-lg bg-white overflow-hidden relative">
          <img src="{{ asset('/CATEGORIA_ESCOLAR.jpg')}}" 
               alt="Cuadernos" 
               class="w-full h-96 object-cover rounded-t-2xl" />
          <div class="p-4 bg-white rounded-b-2xl shadow-md">
            <h3 class="font-extrabold mb-1 text-gray-900">Laminas</h3>
            <p class="text-gray-700">Desde $25 MXN</p>
          </div>
        </article>

        <!-- Card 2 -->
        <article class="flex-shrink-0 snap-center w-72 rounded-2xl shadow-lg bg-white overflow-hidden relative">
          <img src="{{ asset('/Carrucel _ Stikers.png')}}"  
               alt="Plumas y lápices" 
               class="w-full h-96 object-cover rounded-t-2xl" />
          <div class="p-4 bg-white rounded-b-2xl shadow-md">
            <h3 class="font-extrabold mb-1 text-gray-900">Stickers</h3>
            <p class="text-gray-700">Hasta 20% de descuento</p>
          </div>
        </article>

       <!-- Card 1 -->
       <article class="flex-shrink-0 snap-center w-72 rounded-2xl shadow-lg bg-white overflow-hidden relative">
          <img src="{{ asset('/Laminas.png')}}" 
               alt="Cuadernos" 
               class="w-full h-96 object-cover rounded-t-2xl" />
          <div class="p-4 bg-white rounded-b-2xl shadow-md">
            <h3 class="font-extrabold mb-1 text-gray-900">Laminas</h3>
            <p class="text-gray-700">Desde $25 MXN</p>
          </div>
        </article>

        <!-- Card 2 -->
        <article class="flex-shrink-0 snap-center w-flex rounded-2xl shadow-lg bg-white overflow-hidden relative">
          <img src="{{ asset('/Carrucel _ Stikers.png')}}"  
               alt="Plumas y lápices" 
               class="w-full h-96 object-cover rounded-t-2xl" />
          <div class="p-4 bg-white rounded-b-2xl shadow-md">
            <h3 class="font-extrabold mb-1 text-gray-900">Stickers</h3>
            <p class="text-gray-700">Hasta 20% de descuento</p>
          </div>
        </article>


        <!-- Card 5 -->
        <article class="flex-shrink-0 snap-center w-72 rounded-2xl shadow-lg bg-white overflow-hidden relative">
          <img src="https://images.unsplash.com/photo-1627662163964-c3b93a9f5a87?auto=format&fit=crop&w=400&q=80" 
               alt="Agendas y organizadores" 
               class="w-full h-96 object-cover rounded-t-2xl" />
          <div class="p-4 bg-white rounded-b-2xl shadow-md">
            <h3 class="font-extrabold mb-1 text-gray-900">Agendas</h3>
            <p class="text-gray-700">Perfectas para oficina o escuela</p>
          </div>
        </article>

      </div>
    </div>
  </section>

  <script>
    const carousel = document.getElementById('carousel');
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');

    const cardWidth = 288 + 24; 

    prevButton.addEventListener('click', () => {
      carousel.scrollBy({ left: -cardWidth, behavior: 'smooth' });
    });

    nextButton.addEventListener('click', () => {
      carousel.scrollBy({ left: cardWidth, behavior: 'smooth' });
    });
  </script>

</div>
