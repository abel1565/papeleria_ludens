<x-app-layout> 


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

{{-- 
  2. Banner "Lo Nuevo":
  - Lo saqué del <head> y lo puse aquí.
  - w-full: Ocupa todo el ancho del contenedor.
  - rounded-lg: Bordes redondeados.
  - mb-10: Margen inferior para separarlo de los productos.
--}}

{{-- 
  3. Grid de Productos:
  - Mantuve tu grid responsive, ¡está muy bien!
--}}
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-x-6 gap-y-10">

    @forelse ($productos as $producto)
        
        {{-- 
          4. Tarjeta de Producto (¡El cambio más grande!):
          - bg-white: Fondo blanco.
          - rounded-lg: Bordes redondeados.
          - shadow-lg: Sombra suave para darle profundidad.
          - overflow-hidden: Se asegura que la imagen no se salga de los bordes.
          - flex flex-col: Para que el contenido de texto se alinee bien.
          - transition duration-300 hover:shadow-xl: Efecto al pasar el mouse.
        --}}
        <div class=" rounded-lg shadow-lg overflow-hidden flex flex-col transition duration-300 hover:shadow-xl">
            
            {{-- IMAGEN --}}
            <a href="{{ route('productos.view', $producto->id) }}" class="block">
                {{-- Mantuve tus clases de imagen, son perfectas --}}
                <img class="w-full aspect-square object-cover" 
                     src="{{ $producto->image ? asset('storage/' . $producto->image) : 'https://placehold.co/400x400/F3F4F6/9CA3AF?text=No+Image' }}" 
                     alt="Imagen de {{ $producto->name }}" />
            </a>
            
            {{-- 
              5. Contenido de Texto:
              - p-4: Padding interno.
              - flex-grow flex flex-col: Ocupa el espacio restante.
            --}}
            <div class="p-4 flex-grow flex flex-col">
                
                {{-- Título / Nombre --}}
                <a href="{{ route('productos.view', $producto->id) }}">
                    {{-- 
                      - text-base: Tamaño reducido para que quepa mejor.
                      - truncate: Evita que el texto se parta en varias líneas.
                    --}}
                    <h4 class="text-base font-semibold tracking-tight text-gray-900 hover:underline truncate" title="{{ $producto->name }}">
                        {{ $producto->name }}
                    </h4>
                </a>
                
                {{-- Código --}}
                <div class="text-sm text-gray-500 mt-1">
                    Código: {{ $producto->code }}
                </div>
                
                {{-- 
                  6. Precio (mt-auto lo empuja al fondo):
                  - Mantuve tu lógica de 'mt-auto', es excelente.
                --}}
                <div class="mt-auto pt-3">
                    <span class="text-xl font-bold text-gray-900">
                        ${{ number_format($producto->price, 2) }}
                    </span>
                </div>
            </div>
        </div>

    @empty
        
        {{-- MENSAJE SI NO HAY PRODUCTOS --}}
        <div class="col-span-full text-center py-20 bg-white rounded-lg shadow-md">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2z" />
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900">No hay productos nuevos</h3>
            <p class="mt-1 text-sm text-gray-500">
                Vuelve a intentarlo más tarde.
            </p>
        </div>

    @endforelse

</div> {{-- Fin del Grid --}}

</div> {{-- Fin del Contenedor Principal --}}

</x-app-layout>