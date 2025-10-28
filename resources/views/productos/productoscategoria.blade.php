
<x-app-layout>
@dd($subcategoria)
    {{-- CORRECTO: Usamos una propiedad como 'name' o 'nombre' para el título --}}
    <h1 class="text-2xl font-semibold text-gray-700 mb-4">Productos en: "{{ $subcategoria->name }}"</h1>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        {{-- CORRECTO: Recorremos la colección de productos DENTRO de la categoría --}}
        @foreach ($subcategoria->productos as $producto) 
            <div class="w-full bg-white border border-gray-200 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 dark:bg-gray-800 dark:border-gray-700 flex flex-col overflow-hidden">
                <a href="#" class="block aspect-w-16 aspect-h-9 sm:aspect-h-11 md:aspect-h-12 lg:aspect-h-14">
                    {{-- El resto de tu código aquí dentro está perfecto --}}
                    <img class="w-full h-48 object-cover rounded-t-xl" src="{{ $producto->image ? asset('storage/' . $producto->image) : 'https://via.placeholder.com/400x300/F3F4F6/9CA3AF?text=No+Image' }}" alt="Imagen de {{ $producto->name }}" />
                </a>
                <div class="p-5 flex-grow flex flex-col">
                    <a href="#">
                        <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white mb-2">{{ $producto->name }}</h5>
                    </a>
                    
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-300 mb-4">
                        Código: <span class="ml-2 font-medium">{{ $producto->code }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between mt-auto mb-4">
                        <span class="text-2xl font-extrabold text-gray-900 dark:text-white">${{ number_format($producto->price, 2) }}</span>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row items-center justify-between mt-4 gap-3">
                        <a href="{{ route('admin.edit', $producto->id) }}" class="flex-1 w-full text-white bg-blue-600 hover:bg-pink-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-300 ease-in-out">
                            Ver Producto
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Opcional: Mensaje si no hay productos --}}
        @if ($subcategoria->productos->isEmpty())
            <div class="col-span-full text-center py-12 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-sm">
                <p class="text-gray-500 dark:text-gray-300">No hay productos en esta categoría.</p>
            </div>
        @endif

    </div>

</x-app-layout>


