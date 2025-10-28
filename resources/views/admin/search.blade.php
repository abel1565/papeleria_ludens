<x-app-admin> 

<div class="container mx-auto p-6">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">Administrar Productos</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow-md">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-500 text-white p-4 rounded-lg mb-6 shadow-md">{{ session('error') }}</div>
    @endif

    <div class="mb-8 p-4 bg-gray-100 rounded-lg shadow-sm">
        {{-- CORRECCIÓN: Apuntando a tu ruta 'admin.index' --}}
        <form action="{{ route('admin.index') }}" method="GET" class="flex flex-col md:flex-row items-stretch md:items-center gap-4">
            <input 
                type="text" 
                name="search" 
                class="flex-grow px-4 py-2 rounded-lg text-gray-900 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm" 
                placeholder="Buscar por nombre o código..." 
                value="{{ $search ?? '' }}">
            
            <button type="submit" class="bg-indigo-600 hover:bg-pink-500 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-300 ease-in-out">Buscar</button>
            
            {{-- CORRECCIÓN: Apuntando a tu ruta 'admin.index' para limpiar --}}
            <a href="{{ route('admin.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-300 ease-in-out text-center">Limpiar</a>
        </form>
    </div>

    @if ($search)
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Resultados para: "{{ $search }}"</h2>
    @endif
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        @forelse ($productos as $producto)
            <div class="w-full bg-white border border-gray-200 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 dark:bg-gray-800 dark:border-gray-700 flex flex-col overflow-hidden">
                <a href="#" class="block aspect-w-16 aspect-h-9 sm:aspect-h-11 md:aspect-h-12 lg:aspect-h-14">
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
                        {{-- CORRECCIÓN: Apuntando a tu ruta 'admin.edit' --}}
                        <a href="{{ route('admin.edit', $producto->id) }}" class="flex-1 w-full text-white bg-blue-600 hover:bg-pink-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-300 ease-in-out">Editar</a>
                        
                        {{-- CORRECCIÓN: Apuntando a una posible ruta 'admin.destroy' --}}
                        <form action="{{ route('admin.destroy', $producto->id) }}" method="POST" class="flex-1 w-full">
                            @csrf            
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto? Esta acción es irreversible.');" class="w-full text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-300 ease-in-out">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-sm">
                <p class="text-gray-600 dark:text-gray-300 text-xl font-medium">No se encontraron productos.</p>
                @if($search)
                    <p class="text-gray-500 dark:text-gray-400 mt-2">Intenta con otro término de búsqueda.</p>
                    <a href="{{ route('admin.index') }}" class="mt-4 inline-block text-indigo-600 hover:underline dark:text-indigo-400">Ver todos los productos</a>
                @endif
            </div>
        @endforelse

    </div>

    <div class="mt-8 flex justify-center">
        {{ $productos->links() }}
    </div>

</div>

</x-app-admin>