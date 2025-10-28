<x-app-layout>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Crear Nueva Dirección</title>
  </head>
  <body class="bg-gray-50 font-sans text-gray-800">

    <main class="max-w-4xl mx-auto p-4 md:p-8">
      <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
        
        <h1 class="text-3xl font-bold text-gray-900 border-b-2 border-gray-200 pb-4 mb-8">
          Crear Nueva Dirección
        </h1>

        <!-- Formulario de Dirección -->
        <form action="{{ route('address.store') }}" method="POST">
          @csrf

          <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
            
            <!-- Campo: Nombre de contacto -->
            <div class="md:col-span-2">
              <label for="name" class="block text-sm font-semibold text-gray-700">
                Nombre completo (quién recibe) <span class="text-pink-600">*</span>
              </label>
              <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name') }}"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-pink-500 focus:ring-pink-500" 
                required
              >
              @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Campo: CP -->
            <div>
              <label for="cp" class="block text-sm font-semibold text-gray-700">
                Código Postal <span class="text-pink-600">*</span>
              </label>
              <input 
                type="number" 
                id="cp" 
                name="cp" 
                value="{{ old('cp') }}"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-pink-500 focus:ring-pink-500" 
                required
              >
              @error('cp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Campo: Estado -->
            <div>
              <label for="estado" class="block text-sm font-semibold text-gray-700">
                Estado <span class="text-pink-600">*</span>
              </label>
              <input 
                type="text" 
                id="estado" 
                name="estado" 
                value="{{ old('estado') }}"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-pink-500 focus:ring-pink-500" 
                required
              >
              @error('estado') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Campo: Municipio -->
            <div>
              <label for="municipio" class="block text-sm font-semibold text-gray-700">
                Municipio <span class="text-pink-600">*</span>
              </label>
              <input 
                type="text" 
                id="municipio" 
                name="municipio" 
                value="{{ old('municipio') }}"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-pink-500 focus:ring-pink-500" 
                required
              >
              @error('municipio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Campo: Ciudad -->
            <div>
              <label for="ciudad" class="block text-sm font-semibold text-gray-700">
                Ciudad <span class="text-pink-600">*</span>
              </label>
              <input 
                type="text" 
                id="ciudad" 
                name="ciudad" 
                value="{{ old('ciudad') }}"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-pink-500 focus:ring-pink-500" 
                required
              >
              @error('ciudad') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Campo: Calle -->
            <div class="md:col-span-2">
              <label for="calle" class="block text-sm font-semibold text-gray-700">
                Calle <span class="text-pink-600">*</span>
              </label>
              <input 
                type="text" 
                id="calle" 
                name="calle" 
                value="{{ old('calle') }}"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-pink-500 focus:ring-pink-500" 
                required
              >
              @error('calle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Campo: Num Ext -->
            <div>
              <label for="num_ext" class="block text-sm font-semibold text-gray-700">
                Número exterior <span class="text-pink-600">*</span>
              </label>
              <input 
                type="text" 
                id="num_ext" 
                name="num_ext" 
                value="{{ old('num_ext') }}"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-pink-500 focus:ring-pink-500" 
                required
              >
              @error('num_ext') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Campo: Num Int (Opcional) -->
            <div>
              <label for="num_int" class="block text-sm font-semibold text-gray-700">
                Número interior (Opcional)
              </label>
              <input 
                type="text" 
                id="num_int" 
                name="num_int" 
                value="{{ old('num_int') }}"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-pink-500 focus:ring-pink-500"
              >
            </div>

            <!-- Campo: Edificio (Opcional) -->
            <div class="md:col-span-2">
              <label for="edificio" class="block text-sm font-semibold text-gray-700">
                Edificio, departamento, etc. (Opcional)
              </label>
              <input 
                type="text" 
                id="edificio" 
                name="edificio" 
                value="{{ old('edificio') }}"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-pink-500 focus:ring-pink-500"
              >
            </div>

            <!-- Campo: Entre Calle (Opcional) -->
            <div>
              <label for="entre_calle" class="block text-sm font-semibold text-gray-700">
                Entre calle (Opcional)
              </label>
              <input 
                type="text" 
                id="entre_calle" 
                name="entre_calle" 
                value="{{ old('entre_calle') }}"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-pink-500 focus:ring-pink-500"
              >
            </div>

            <!-- Campo: Y Calle (Opcional) -->
            <div>
              <label for="y_calle" class="block text-sm font-semibold text-gray-700">
                Y calle (Opcional)
              </label>
              <input 
                type="text" 
                id="y_calle" 
                name="y_calle" 
                value="{{ old('y_calle') }}"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-pink-500 focus:ring-pink-500"
              >
            </div>

            <!-- Campo: Num Celular -->
            <div>
              <label for="num_celular" class="block text-sm font-semibold text-gray-700">
                Número de celular <span class="text-pink-600">*</span>
              </label>
              <input 
                type="tel" 
                id="num_celular" 
                name="num_celular" 
                value="{{ old('num_celular') }}"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-pink-500 focus:ring-pink-500" 
                required
                placeholder="Ej. 222 123 4567"
              >
              @error('num_celular') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Campo: Num Particular (Opcional) -->
            <div>
              <label for="num_particular" class="block text-sm font-semibold text-gray-700">
                Número de casa (Opcional)
              </label>
              <input 
                type="tel" 
                id="num_particular" 
                name="num_particular" 
                value="{{ old('num_particular') }}"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-pink-500 focus:ring-pink-500"
              >
            </div>
          </div>

          <!-- Botones de Acción -->
          <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-4">
            <a 
              href="{{ route('carrito.carrito') }}" 
              class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-full transition"
            >
              Cancelar
            </a>
            <button 
              type="submit" 
              class="bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2 px-6 rounded-full transition shadow-md"
              style="background-color: #be185d;" {{-- Usamos el color magenta de tu app --}}
            >
              Guardar Dirección
            </button>
          </div>

        </form>
      </div>
    </main>

  </body>
</html>
</x-app-layout>
