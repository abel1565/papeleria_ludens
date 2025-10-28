<x-app-layout>
    {{-- Título de la Subcategoría --}}
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">
            Productos de: {{ $subcategoria->subcategoria }}
        </h1>

        {{-- 
          Grid de Productos
          - Cambiado a 2, 3 y 5 columnas
          - Ajustado el gap (espaciado)
        --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-x-6 gap-y-10">

            {{-- 
              Usamos @forelse para mostrar un mensaje si no hay productos
            --}}
            @forelse ($subcategoria->productos as $producto)
                
                {{-- 
                  CARD DEL PRODUCTO
                  - Se quitó: bg-white, border, shadow, rounded-xl
                  - Es solo un contenedor flex-col
                --}}
                <div class="flex flex-col">
                    
                    {{-- IMAGEN --}}
                    <a href="#" class="block mb-3">
                        <img class="w-full aspect-square object-cover rounded-lg" 
                             src="{{ $producto->image ? asset('storage/' . $producto->image) : 'https://via.placeholder.com/400x400/F3F4F6/9CA3AF?text=No+Image' }}" 
                             alt="Imagen de {{ $producto->name }}" />
                    </a>
                    
                    {{-- CONTENIDO DE TEXTO --}}
                    <div class="flex-grow flex flex-col">
                        
                        {{-- Título / Nombre --}}
                        <a href="{{ route('productos.view', $producto->id) }}">
                            <h4 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white hover:underline">
                                {{ $producto->name }}
                            </h4>
                        </a>
                        
                        {{-- Código (un poco más sutil) --}}
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Código: {{ $producto->code }}
                        </div>
                        
                        {{-- Precio (mt-auto empuja esto y el botón al final) --}}
                        <div class="mt-auto pt-3">
                            <span class="text-xl font-bold text-gray-900 dark:text-white">
                                ${{ number_format($producto->price, 2) }}
                            </span>
                        </div>
                        
             
                    </div>
                </div>

            @empty
                
                {{-- MENSAJE SI NO HAY PRODUCTOS --}}
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">
                        Aún no hay productos en esta subcategoría.
                    </p>
                </div>

            @endforelse

        </div> {{-- Fin del Grid --}}
    </div> {{-- Fin del Container --}}
</x-app-layout>