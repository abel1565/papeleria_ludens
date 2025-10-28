<x-app-layout>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Resumen de Pedido</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-900 p-8">
  <br>

  <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12">

    <!-- Left: Métodos de entrega + datos -->
    <section class="md:col-span-2 space-y-8">

      <!-- Método de entrega -->
      <div>
        
        <div class="space-y-4 max-w-md">
          <button class="w-full flex items-center space-x-3 px-5 py-4 border-2 border-black rounded-lg font-semibold text-black focus:outline-none focus:ring-2 focus:ring-black">
            <!-- Icono domicilio -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
            </svg>
            <span>Entrega en domicilio</span>
          </button>
        </div>
      </div>

      <!-- Datos de entrega -->
      <div>
        <div class="flex justify-between items-center mb-2 max-w-md">
          <h3 class="text-xl font-bold">Datos de entrega</h3>
          <button class="px-4 py-1 border border-gray-300 rounded-full text-sm font-semibold hover:bg-gray-100 transition">Editar</button>
        </div>
        <p class="text-gray-600 max-w-md leading-relaxed">
          Abel Barojas Sánchez<br />
          Fortín 23, Hacienda los capulines 2<br />
          abelbarojassanchez25@gmail.com<br />
          222 579 9606
        </p>
      </div>

      <!-- Datos de facturación -->
      <div>
        <div class="flex justify-between items-center mb-2 max-w-md">
          <h3 class="text-xl font-bold">Datos de facturación</h3>
          <button class="px-4 py-1 border border-gray-300 rounded-full text-sm font-semibold hover:bg-gray-100 transition">Editar</button>
        </div>
        <p class="text-gray-600 max-w-md leading-relaxed">
          Abel Barojas Sánchez<br />
          Fortín 23, Hacienda los capulines 2<br />
          abelbarojassanchez25@gmail.com<br />
          222 579 9606
        </p>
      </div>

      <!-- Datos de envío -->
      <div>
        <h3 class="text-xl font-bold">Datos de envío</h3>
        <!-- Aquí puedes agregar info adicional si deseas -->
      </div>

    </section>

    <!-- Right: Resumen pedido -->
    <section class="bg-white rounded-lg shadow border border-gray-200 p-6 max-w-md mx-auto">

      <h2 class="text-xl font-bold mb-6">Resumen del pedido</h2>
      
      <dl class="divide-y divide-gray-200 text-sm text-gray-700 mb-6">
        <div class="flex justify-between py-2">
          <dt>Subtotal <button title="¿Por qué este precio?">❔</button></dt>
          <dd class="font-medium text-gray-900">$2,879.00</dd>
        </div>
        <div class="flex justify-between py-2">
          <dt>Precio original</dt>
          <dd class="line-through text-gray-400">$3,599.00</dd>
        </div>
        <div class="flex justify-between py-2">
          <dt>Entrega/Envío</dt>
          <dd class="font-semibold">Gratis</dd>
        </div>
      </dl>

      <div class="flex justify-between border-t border-gray-200 pt-4 mb-4 font-bold">
        <span>Total</span>
        <span>$2,879.00</span>
      </div>

      <div class="flex items-center space-x-2 text-green-600 font-semibold mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
        <span>Ahorra $720.00</span>
      </div>
    </section>
    
  </div>

</body>
</html>

</x-app-layout>