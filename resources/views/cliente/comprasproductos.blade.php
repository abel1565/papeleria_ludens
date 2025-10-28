<x-app-layout>
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-xl">

    {{-- Información general de la compra --}}
    @if ($items->isNotEmpty())
        @php
            $order = $items->first()->order; // Obtenemos la orden desde el primer item
        @endphp

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center pb-4 border-b border-gray-200 mb-6">
            <div>
                <p class="text-sm text-gray-600 mb-1">
                    Fecha de compra: {{ $order->created_at->format('d/m/Y H:i') }}
                </p>

                <p class="text-xl font-bold text-gray-900">
                    Total de la compra: ${{ number_format($order->total, 2) }}
                </p>
            </div>
        </div>

        <h2 class="text-xl font-semibold text-gray-900 mb-4">Detalle de compra</h2>

        {{-- LISTA DE PRODUCTOS --}}
        @foreach ($items as $item)
        <div class="flex items-start space-x-4 p-4 border border-gray-100 rounded-lg bg-gray-50 mb-4">
            
            {{-- Imagen producto --}}
            <div class="flex-shrink-0 w-20 h-20 bg-white rounded-md flex items-center justify-center border border-gray-200 overflow-hidden">
                <img src="{{ $item->producto->image ? asset('storage/' . $item->producto->image) : 'https://via.placeholder.com/80x80.png?text=Producto' }}"
                    alt="{{ $item->producto->name }}"
                    class="w-full h-full object-contain">
            </div>

            {{-- Info producto --}}
            <div class="flex-grow">
                <p class="text-base font-bold text-gray-900 uppercase tracking-wider mb-2">
                    {{ $item->producto->name }}
                </p>

                <div class="space-y-1 text-sm text-gray-700">
                    <p>SKU: <span class="font-medium text-gray-900">{{ $item->producto->sku }}</span></p>
                    <p>Cantidad: <span class="font-medium text-gray-900">{{ $item->quantity }}</span></p>

                    {{-- Si después agregas colores, los mostramos aquí --}}
                    @if(!empty($item->producto->color))
                        <p>Color: <span class="font-medium text-gray-900">{{ $item->producto->color }}</span></p>
                    @endif
                </div>

                <p class="mt-3 text-lg font-bold text-gray-900">
                   Precio: ${{ number_format($item->price, 2) }} 
                </p>
            </div>
        </div>
        @endforeach

    @else
        <p class="text-gray-600 text-center py-4">
            No se encontraron productos para esta compra.
        </p>
    @endif

</div>
<br>

<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-xl">

    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Dirección de envío</h2>

    <div class="flex flex-col space-y-4 p-4 border border-gray-100 rounded-lg bg-gray-50">
        <p class="text-base font-bold text-gray-900 uppercase tracking-wider">{{ $direccion->name }}</p>
        <p class="text-sm text-gray-700">{{ $direccion->calle }} {{ $direccion->num_ext }}
            @if($direccion->num_int), Int. {{ $direccion->num_int }} @endif
        </p>
        @if($direccion->edificio)
            <p class="text-sm text-gray-700">Edificio: {{ $direccion->edificio }}</p>
        @endif
        @if($direccion->entre_calle || $direccion->y_calle)
            <p class="text-sm text-gray-700">Entre calles: {{ $direccion->entre_calle }} y {{ $direccion->y_calle }}</p>
        @endif
        <p class="text-sm text-gray-700">{{ $direccion->municipio }}, {{ $direccion->ciudad }}, {{ $direccion->estado }}. CP {{ $direccion->cp }}</p>
        <p class="text-sm text-gray-700">Celular: {{ $direccion->num_celular }}</p>
        @if($direccion->num_particular)
            <p class="text-sm text-gray-700">Teléfono particular: {{ $direccion->num_particular }}</p>
        @endif
    </div>



</div>

</x-app-layout>
