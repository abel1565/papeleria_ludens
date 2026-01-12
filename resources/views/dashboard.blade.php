<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

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

<br>

    <x-carrousel :images="[
    'imagen carrusel-dnovac.jpg',
    'imagen carrusel- dasboard1011-1200x600.png',
    'imagen carrusel-agenda (1).jpg'],"/>


    


    <x-cards-carrousel
    title="Los mejores precios en papelería"
    :items="[
        [
            'image' => asset('/CATEGORIA_DIDACTICOS.jpg'),
        ],
        [
            'image' => asset('/CATEGORIA_ESCOLAR.jpg'),
        ],
        [
            'image' => asset('/CATEGORIA_MANUALIDADES.jpg'),
        ],
        [
            'image' => asset('/CATEGORIA_OFICINA.jpg'),
        ],

    ]"
/>
<!--
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 text-4xl font-semibold">
            {{ __(" Back To Scool ") }}
          </div>
        </div>
      </div>
    </div>
      -->


</body>

<livewire:layout.footer/>

    
</x-app-layout>
