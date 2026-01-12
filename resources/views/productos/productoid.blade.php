<x-app-layout>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

  <header class="bg-gradient-to-r from-pink-600 to-purple-800 p-6">
    <h1 class="text-white text-3xl font-extrabold tracking-wide">{{ $producto->name }}</h1>
    <p class="text-pink-300 font-semibold mt-1"> CODIGO: {{ $producto->code }}</p>
  </header>

  <main class="max-w-7xl mx-auto p-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
  <section class="flex flex-col items-center justify-start space-y-4">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 w-full max-w-md">
      <img 
        src="{{ $producto->image ? asset('storage/' . $producto->image) : 'https://via.placeholder.com/400x300/F3F4F6/9CA3AF?text=No+Image' }}"
        alt="{{ $producto->name }}"
        class="w-full h-auto object-contain"
      />
    </div>
    <p class="text-center mt-2 font-bold text-pink-600 uppercase">
      Disponibles {{$producto->stock }} piezas
    </p>
  </section>

  <section class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
    <h2 class="text-2xl font-bold border-b-2 border-gray-300 pb-3 mb-5">
      Descripción del Producto
    </h2>

    <p class="mb-4 leading-relaxed">
      <span class="font-semibold">{{ $producto->description }}</span> 
    </p>




    <div class="mb-8">

    @auth
                    <p class="font-extrabold text-lg text-gray-900">
                      Precio por Pieza: <span class="text-pink-600">${{ number_format($producto->price, 2) }}</span>
                    </p>
                    @else
                        <div class="text-gray-500 text-sm">
                            Inicia sesión para ver el precio
                        </div>
                    @endauth

      <p class="font-extrabold text-lg text-gray-900">Paquete con {{$producto->pieces_per_package }} piezas</p>
      <p class="text-blue-600 font-semibold mt-2">Empaque con {{$producto->pieces_per_box }} Piezas</p>
      <p class="text-pink-600 font-bold text-sm">
        Venta en múltiplos de colores surtidos variado a existencias
      </p>
    </div>

    <ul class="divide-y divide-gray-200 mb-8">
      <li class="py-2 flex justify-between"><span class="font-semibold">Material:</span> {{$producto->material }}</li>
      <li class="py-2 flex justify-between"><span class="font-semibold">Colores disponibles:</span>

        
        <div class="flex items-center gap-3">
            @forelse($producto->colores as $color)
                
                {{-- 3. ...y pones CADA CÍRCULO directamente dentro de la fila --}}
                <span class="w-5 h-5 rounded-full border border-gray-300" 
                      style="background-color: {{ $color->colores }}"
                      title="{{ $color->nombre ?? $color->colores }}"> 
                </span>

            @empty
                {{-- Esto se muestra si no hay colores --}}
                <p class="text-pink-600 font-bold text-sm">
                  Colores no disponibles 
                </p>
            @endforelse
        </div>
      </li>
      <li class="py-2 flex justify-between"><span class="font-semibold">Modelos disponibles:</span> {{$producto->models }}</li>
      <li class="py-2 flex justify-between"><span class="font-semibold">Medidas:</span> {{$producto->measurements }} cm</li>
      <li class="py-2 flex justify-between"><span class="font-semibold">Número de separadores:</span> {{$producto->separators }}</li>
      <li class="py-2 italic text-gray-600">{{$producto->extra_notes }}</li>
      <li class="py-2 flex justify-between"><span class="font-semibold">Peso:</span> {{$producto->weight }} g</li>
    </ul>

    <div class="flex space-x-4 mb-10">

      <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
        @csrf

        <input type="hidden" name="product_id" value="{{ $producto->id }}">
        
        <button 
          type="submit"
          class="w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-3 rounded-lg shadow transition"
        >
          Agregar al carrito
        </button>
      </form>

    </div>
</x-app-layout>