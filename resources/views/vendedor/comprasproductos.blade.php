<x-app-vendedor>
  <div class="max-w-5xl mx-auto p-6 bg-white rounded-lg shadow-lg">
      <h1 class="text-2xl font-bold mb-6">Detalles de la Orden : {{ $order->ref }}</h1>

      <p class="text-gray-600 mb-4">
          Cliente: <span class="font-semibold">{{ $order->user->name }}</span><br>
          Correo: <span class="font-semibold">{{ $order->user->email }}</span><br>
          Telefono de Contacto: <span class="font-semibold">{{ $order->user->phone }}</span><br>
          Fecha: <span class="font-semibold">{{ $order->created_at->format('d/m/Y') }}</span>
      </p>

      <h2 class="text-lg font-semibold mb-3">Productos comprados</h2>
      <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
          @forelse ($items as $item)
              <div class="flex items-center gap-4 border-b border-gray-200 py-3">
                  <img src="{{ $item->producto->image ? asset('storage/' . $item->producto->image) : 'https://via.placeholder.com/80' }}"
                       alt="{{ $item->producto->name }}"
                       class="w-20 h-20 object-contain rounded-md bg-white border">
                  <div class="flex-1">
                      <p class="font-bold text-gray-900">{{ $item->producto->name }}</p>
                      <p class="text-sm text-gray-600">Cantidad: {{ $item->quantity }}</p>
                      <p class="text-sm text-gray-600">Precio: ${{ number_format($item->price, 2) }}</p>
                    </div>
                  
                <div class="flex 1">
                    @forelse($item->producto->colores as $color)
                        <span class="w-5 h-5 rounded-full border border-gray-300"
                              style="background-color: {{ $color->colores }}"
                              title="{{ $color->nombre ?? $color->colores }}">
                        </span>
                    @empty
                        <p class="text-pink-600 font-bold text-sm">Colores no disponibles</p>
                    @endforelse
                </div>
                  <div class="font-semibold text-gray-800">
                      ${{ number_format($item->quantity * $item->price, 2) }}
                  </div>
              </div>
          @empty
              <p class="text-gray-600 text-center py-4">No se encontraron productos en esta orden.</p>
          @endforelse
      </div>

      <div class="mt-6">
    <h2 class="text-lg font-semibold mb-3">Dirección de envío</h2>

    @if($direccion)
    <h1 lass="text-lg font-semibold mb-3"> {{ $direccion->name ?? '' }}</h1>

        <p>
            {{ $direccion->calle ?? '' }} {{ $direccion->num_ext ?? '' }}
            @if($direccion->num_int) Int. {{ $direccion->num_int }} @endif
            @if($direccion->edificio) , Edificio {{ $direccion->edificio }} @endif
        </p>

        @if($direccion->entre_calle || $direccion->y_calle)
            <p>Entre calles: {{ $direccion->entre_calle ?? '' }} y {{ $direccion->y_calle ?? '' }}</p>
        @endif

        <p>
            {{ $direccion->ciudad ?? '' }}, {{ $direccion->municipio ?? '' }}, {{ $direccion->estado ?? '' }}. CP {{ $direccion->cp ?? '' }}
        </p>

        <p>Celular: {{ $direccion->num_celular ?? '' }}</p>

        @if($direccion->num_particular)
            <p>Teléfono particular: {{ $direccion->num_particular }}</p>
        @endif
    @else
        <p class="text-gray-500">No se encontró dirección asociada a esta orden.</p>
    @endif
</div>

      <div class="mt-8 flex justify-end">
          <a href="{{ route('vendedor.cliente') }}"
             class="bg-gray-700 hover:bg-gray-800 text-white font-semibold px-5 py-2 rounded-lg">
              ← Volver a órdenes
          </a>
      </div>
  </div>
</x-app-vendedor>
