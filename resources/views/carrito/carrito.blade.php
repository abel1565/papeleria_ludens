<x-app-layout>
<main class="max-w-7xl mx-auto p-4 md:p-8 flex flex-col md:flex-row gap-8" x-data="{ selectedAddress: @js($addresses[0]->id ?? null) }">

  <!-- COLUMNA IZQUIERDA: CARRITO -->
  <section class="flex-1">
    <h1 class="text-2xl font-semibold mb-6">Mi carrito</h1>

    <!-- Bolsa de compra -->
    <div>
      <h2 class="text-xl font-semibold mb-6">Bolsa de compra</h2>

      @forelse ($cart->items ?? [] as $item)
        @if($item->productos)
          @php
            $producto = $item->productos;
            $colores = $producto->colores;
            $descripcion= $producto->description;
            $colorNombres = $colores->pluck('nombre')->implode('/');
            $categoria = $producto->subcategorias->pluck('nombre')->first() ?? 'Producto';
          @endphp
          <article class="flex flex-col sm:flex-row items-center sm:items-start gap-6 border-b border-gray-200 pb-6 mb-6">

            <!-- Imagen -->
            @php
  // Verifica si la ruta es absoluta o relativa
  $imageUrl = $producto->image
      ? (Str::startsWith($producto->image, ['http://', 'https://']) 
          ? $producto->image 
          : asset('storage/' . ltrim($producto->image, '/')))
      : 'https://via.placeholder.com/400x400?text=Sin+Imagen';
@endphp

<div class="bg-gray-100 flex justify-center items-center w-40 h-40 sm:w-52 sm:h-52 rounded-xl overflow-hidden shadow-sm">
  <img src="{{ $imageUrl }}"
       alt="{{ $producto->name }}"
       class="w-full h-full object-contain transition-transform duration-300 hover:scale-105" />
</div>

            <!-- Info producto -->
             
              <div class="flex-1 w-full">
        <div class="flex justify-between items-start">
          <div>
            <h3 class="font-semibold text-lg text-gray-900">{{ $producto->name }}</h3>
            
            <p class="text-gray-500 text-sm mt-1">{{ $producto->description}}</p>

            <div class="py-2 flex justify-between"><span class="font-semibold">Colores:</span>

        
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
</div>
          </div>

      

          <div class="text-right font-semibold text-lg text-gray-900">
            ${{ number_format($item->price, 2) }}
          </div>
        </div>

              <!-- Controles de cantidad y eliminar -->
              <div class="mt-5 flex items-center gap-4">

                <!-- Eliminar -->
                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('¿Estás seguro de eliminar?')" 
                          class="border border-gray-300 rounded-full p-2 hover:bg-gray-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </form>

                <!-- Cantidad -->
                <div class="flex items-center border border-gray-300 rounded-full overflow-hidden">
                  <form action="{{ route('cart.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                    <button type="submit" class="px-3 py-1 hover:bg-gray-100 transition text-lg font-semibold @if($item->quantity <= 1) opacity-50 pointer-events-none @endif">-</button>
                  </form>

                  <span class="px-4 py-1">{{ $item->quantity }}</span>

                  <form action="{{ route('cart.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                    <button type="submit" class="px-3 py-1 hover:bg-gray-100 transition text-lg font-semibold">+</button>
                  </form>
                </div>
              </div>
            </div>
          </article>
        @endif
      @empty
        <div class="text-center py-10 border-b border-gray-200">
          <p class="text-xl text-gray-700">Tu bolsa de compra está vacía.</p>
          <a href="{{ route('dashboard') }}" class="mt-4 inline-block font-semibold text-magenta-600 hover:underline">Seguir comprando</a>
        </div>
      @endforelse
    </div>

    <!-- SECCIÓN DIRECCIONES -->
    <div class="mt-12">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Dirección de envío</h2>
        <a href="{{ route('address.create') }}" class="bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2 px-5 rounded-full transition text-sm shadow-md">
          Crear nueva dirección
        </a>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse ($addresses ?? Auth::user()->addresses ?? [] as $address)
          <div @click="selectedAddress = {{ $address->id }}" 
               :class="selectedAddress === {{ $address->id }} ? 'border-pink-500 ring-2 ring-pink-500' : 'border-gray-200'" 
               class="cursor-pointer block p-5 rounded-xl border-2 bg-white shadow-sm transition">
            <p class="font-bold text-lg text-gray-900">{{ $address->name }}</p>
            <p class="text-gray-600 mt-1">{{ $address->calle }} {{ $address->num_ext }}
              @if($address->num_int), Int. {{ $address->num_int }} @endif
            </p>
            <p class="text-gray-600">{{ $address->municipio }}, {{ $address->ciudad }}, {{ $address->estado }}. CP {{ $address->cp }}</p>
            <p class="text-gray-600 mt-2 font-medium">{{ $address->num_celular }}</p>
          </div>
        @empty
          <div class="md:col-span-2 bg-gray-50 p-6 rounded-lg text-center">
            <p class="text-gray-600">No tienes direcciones guardadas.</p>
            <p class="text-gray-500 text-sm mt-1">Por favor, crea una nueva dirección para continuar.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- COLUMNA DERECHA: RESUMEN Y CHECKOUT -->
  <form action="{{ route('checkout.process') }}" method="POST" class="md:w-96" x-data>
    @csrf
    <input type="hidden" name="address_id" :value="selectedAddress">
    <aside class="w-full border border-gray-200 rounded-lg p-6 flex flex-col gap-6 h-fit sticky top-8 bg-white shadow-lg">
      <h2 class="text-xl font-semibold">Resumen</h2>

      <div class="flex justify-between items-center">
        <span class="text-gray-800">Subtotal</span>
        <span class="font-semibold">${{ number_format($subtotal, 2) }}</span>
      </div>

      <div class="flex justify-between items-center text-gray-700">
        <span>{{ $shipping == 0 ? '' : '$' . number_format($shipping, 2) }}</span>
      </div>

      <hr aria-hidden="true" class="my-4 border-gray-300" />

      <div class="flex justify-between items-center font-semibold text-lg">
        <span>Total</span>
        <span class="font-semibold">${{ number_format($final, 2) }}</span>
      </div>

      <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-semibold rounded-full py-3 w-full transition text-center shadow-md">
        Realizar Pedido
      </button>
    </aside>
  </form>
</main>

</x-app-layout>

