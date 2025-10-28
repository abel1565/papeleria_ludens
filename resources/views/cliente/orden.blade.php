<x-app-layout>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Confirmación de Pedido</title>
  {{-- <script src="https://cdn.tailwindcss.com"></script> --}} {{-- ELIMINADO --}}
</head>
<body class="bg-gray-50 font-sans text-gray-800">

  <!-- Encabezado con el No. de Pedido -->
  <header class="bg-gradient-to-r from-pink-600 to-purple-800 p-6 text-white shadow-lg">
    <div class="max-w-7xl mx-auto">
      <h1 class="text-3xl font-extrabold tracking-wide">¡Gracias por tu compra!</h1>
      <p class="text-pink-200 font-semibold mt-2 text-xl">
        Tu Pedido: <span class="font-bold tracking-wider">{{ $order->ref }}</span>
      </p>
    </div>
  </header>

  <main class="max-w-7xl mx-auto p-4 md:p-8 flex flex-col lg:flex-row gap-8 items-start">
    
    <!-- Columna Izquierda: Detalles e Instrucciones de Pago -->
    <section class="flex-1 lg:col-span-2 space-y-8">

      <!-- 1. Lista de Productos Pedidos -->
      <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg border border-gray-200">
        <h2 class="text-2xl font-bold border-b-2 border-gray-300 pb-3 mb-6">
          Productos en tu pedido
        </h2>

        <div class="space-y-6">
          {{-- Iteramos sobre los 'items' de la orden --}}
          @forelse ($order->items as $item)
            {{-- Asumimos que la relación en OrderItem se llama 'producto' (singular) --}}
            @if ($item->producto)
              <article class_="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                <!-- Imagen -->
                <div class="bg-gray-100 p-2 flex justify-center items-center w-24 h-24 rounded-lg border">
                  <img
                    src="{{ $item->producto->image ? asset('storage/' . $item->producto->image) : 'https://via.placeholder.com/100' }}"
                    alt="{{ $item->producto->name }}"
                    class="object-contain max-h-full"
                  />
                </div>
                <!-- Detalles -->
                <div class="flex-1 w-full">
                  <div class="flex justify-between items-start">
                    <div>
                      <h3 class="font-semibold text-lg">{{ $item->producto->name }}</h3>
                      <p class="text-gray-500 mt-1 text-sm">
                        Cantidad: <span class="font-medium text-gray-800">{{ $item->quantity }}</span>
                      </p>
                    </div>
                    <div class="text-right font-semibold text-lg">
                      ${{ number_format($item->price * $item->quantity, 2) }}
                      <p class="text-sm text-gray-500 font-normal">(${{ number_format($item->price, 2) }} c/u)</p>
                    </div>
                  </div>
                </div>
              </article>
              <hr class="last:hidden">
            @endif
          @empty
            <p class="text-gray-600">No se encontraron artículos en esta orden.</p>
          @endforelse
        </div>
      </div>

      <!-- 2. Instrucciones de Pago (Mensaje Especial) -->
      <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg border border-gray-200">
        <h2 class="text-2xl font-bold text-pink-700 border-b-2 border-gray-300 pb-3 mb-6">
          ¡Importante! Siguientes Pasos
        </h2>
        
        <p class="text-gray-700 text-base leading-relaxed mb-4">
          En unos minutos, te llegará un correo a: 
          <strong class="text-gray-900">{{ $order->user->email }}</strong>
        </p>
        <p class="text-gray-700 text-base leading-relaxed mb-6">
          En ese correo encontrarás las especificaciones de los datos de pago para que puedas hacer la transferencia.
        </p>

        <div class="bg-pink-50 border-2 border-pink-500 rounded-lg p-5 text-center">
          <p class="font-semibold text-pink-800 text-base">
            En el concepto de la transferencia, deberás agregar el número de orden tal cual está escrito:
          </p>
          <p class="text-3xl font-extrabold text-pink-700 mt-3 tracking-wider bg-white py-2 rounded border border-pink-300">
            {{ $order->ref }}
          </p>
        </div>
      </div>

    </section>

    <!-- Columna Derecha: Resumen de la Orden -->
    <aside class="w-full lg:w-96 border border-gray-200 rounded-lg p-6 flex flex-col gap-6 h-fit sticky top-8 bg-white shadow-lg">
      <h2 class="text-xl font-semibold border-b pb-3">Resumen del Pedido</h2>

      {{-- Calculamos el subtotal (antes de descuentos) --}}
      @php
        $subtotal = $order->items->sum('subtotal');
        $discount = $subtotal - $order->total;
      @endphp

      <div class="flex justify-between items-center text-gray-800">
        <span>Subtotal (sin descuento):</span>
        <span class="font-semibold">${{ number_format($subtotal, 2) }}</span>
      </div>

      <div class="flex justify-between items-center text-pink-600">
        <span>Descuento aplicado:</span>
        <span class="font-semibold">-${{ number_format($discount, 2) }}</span>
      </div>
      
      <div class="flex justify-between items-center text-gray-700">
        <span>Envío:</span>
        <span>Gratis</span> {{-- (Asumiendo que es gratis) --}}
      </div>

      <hr aria-hidden="true" class="my-2 border-gray-300" />

      <div class="flex justify-between items-center font-bold text-lg text-gray-900">
        <span>Total Pagado:</span>
        <span>${{ number_format($order->total, 2) }}</span>
      </div>

      <div class="flex justify-between items-center text-gray-700 text-sm">
        <span>Estado:</span>
        <span class="font-semibold bg-yellow-200 text-yellow-800 px-3 py-1 rounded-full capitalize">
          {{ $order->status }} {{-- (Ej: 'pending') --}}
        </span>
      </div>

      <div class="flex justify-between items-center text-gray-700 text-sm">
        <span>Método de pago:</span>
        <span class="font-semibold capitalize">
          {{ $order->payment_method }}
        </span>
      </div>

      <!-- Botón para regresar -->
      <a
        href="{{ route('dashboard') }}" {{-- O 'home', o la ruta que uses para la página principal --}}
        class="bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-full py-3 w-full transition text-center mt-4"
      >
        Regresar a la Página Principal
      </a>
    
    </aside>
  </main>

  {{-- 
    ELIMINADO: Este bloque <style> ya no es necesario 
    porque estás usando la instalación completa de Tailwind.
  --}}

</body>
</html>
</x-app-layout>