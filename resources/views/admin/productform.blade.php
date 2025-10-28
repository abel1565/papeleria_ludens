<x-app-admin>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Crear Producto - Formulario</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }
  </style>
</head>


<body class="bg-white text-gray-900 min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-7xl">
    <h1 class="text-2xl font-bold mb-6 text-center">Agrega un Producto</h1>

    <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data"

        class="flex flex-col md:flex-row gap-8 bg-gray-100 rounded-2xl p-6 md:p-10 shadow-lg">
      @csrf

      @if (session('success'))
          <div class="w-full bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
              <p class="font-bold">Éxito</p>
              <p>{{ session('success') }}</p>
          </div>
      @endif

      @if (session('error'))
          <div class="w-full bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
              <p class="font-bold">¡Error!</p>
              <p>{{ session('error') }}</p>
          </div>
      @endif

      @if ($errors->any())
          <div class="w-full bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
              <p class="font-bold">¡Error de Validación!</p>
              <ul class="mt-2 list-disc list-inside">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      <div class="flex-shrink-0 w-full md:w-96" x-data="{ imagePreview: null }">
        <div class="h-96 bg-white rounded-2xl p-4 flex flex-col items-center justify-center relative overflow-hidden shadow-lg border border-gray-300">
          <label for="image" class="flex flex-col items-center justify-center w-full h-full border-2 border-dashed border-gray-400 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-200 transition">
            <template x-if="!imagePreview">
              <div class="flex flex-col items-center justify-center pt-5 pb-6 px-4 text-gray-500">
                <svg class="w-10 h-10 mb-4" aria-hidden="true" xmlns="http://www.w.org/2000/svg" fill="none" viewBox="0 0 20 16"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5A5.5 5.5 0 0 0 5.207 5C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" /></svg>
                <p class="mb-2 text-sm text-center"><span class="font-semibold">Haz clic para subir</span></p>
                <p class="text-xs text-center">JPG, PNG (máx. 2MB)</p>
              </div>
            </template>
            <template x-if="imagePreview">
              <div class="absolute inset-0 w-full h-full">
                <img :src="imagePreview" alt="Previsualización" class="w-full h-full object-cover rounded-xl" />
                <button type="button" @click.prevent="imagePreview = null; $refs.imageInput.value = null;"
                  class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white rounded-full p-2 text-xs z-10" title="Eliminar imagen">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
              </div>
            </template>
            <input id="image" name="image" type="file" accept="image/*" class="hidden" x-ref="imageInput"
                  @change="file = $event.target.files[0]; if (file) { reader = new FileReader(); reader.onload = (e) => imagePreview = e.target.result; reader.readAsDataURL(file); } else { imagePreview = null; }">
          </label>
        </div>
      </div>

      <div class="flex-1 flex flex-col gap-5 sm:gap-4 p-0 md:p-0 text-gray-900">

        <div x-data="{ 
              selectedCategory: null, 
              subcategories: [],
              fetchSubcategories() {
                  if (!this.selectedCategory) { this.subcategories = []; return; }
                  fetch(`/subcategorias/${this.selectedCategory}`)
                      .then(response => response.json())
                      .then(data => { this.subcategories = data; });
              }
            }" class="contents">
          
          <div>
              <label for="categoria_id" class="block text-sm font-medium mb-1">Categoría</label>
              <select id="categoria_id" name="categoria_id" x-model="selectedCategory" @change="fetchSubcategories()" class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-600" required>
                  <option value="">Selecciona una categoría</option>
                  @foreach($categorias as $categoria)
                      <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                  @endforeach
              </select>
          </div>
    
          <div>
            <label for="subcategoria_id" class="block text-sm font-medium mb-1">Subcategoría</label>
            <select id="subcategoria_id" name="subcategoria_id" class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-600" :disabled="!selectedCategory || subcategories.length === 0" required>
                <option value="">Selecciona una subcategoría</option>
                <template x-for="subcategory in subcategories" :key="subcategory.id">
                    <option :value="subcategory.id" x-text="subcategory.subcategoria"></option>
                </template>
            </select>
          </div>
        </div>
        
        <div>
          <label for="name" class="block text-sm font-medium mb-1">Nombre del Producto</label>
          <input id="name" name="name" type="text" placeholder="Nombre del producto" class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 placeholder-gray-400 text-base focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent" required />
        </div>

        <div>
          <label for="code" class="block text-sm font-medium mb-1">Código del Producto</label>
          <input id="code" name="code" type="text" placeholder="Ejemplo: PD14ZX" class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 placeholder-gray-400 text-base focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent" required />
        </div>

        <div>
          <label for="stock" class="block text-sm font-medium mb-1">Cantidad Disponible</label>
          <input id="stock" name="stock" type="number" min="0" placeholder="Ejemplo: 100" class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 placeholder-gray-400 text-base focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent" required />
        </div>

        <div>
          <label for="description" class="block text-sm font-medium mb-1">Descripción</label>
          <textarea id="description" name="description" rows="4" placeholder="Descripción detallada del producto" class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 placeholder-gray-400 text-base resize-y focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent" required></textarea>
        </div>
      
        <div>
            <label class="block text-sm font-medium mb-1">Colores Disponibles</label>
            <div class="flex flex-wrap gap-3">
                @foreach($colors as $color)
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="colors[]" value="{{ $color->id }}" 
                           class="h-8 w-8 text-pink-600 border-gray-300 rounded" 
                           style="background-color: {{ $color->colores }};">
                    <span>{{ $color->nombre ?? $color->colores }}</span>
                </label>
                @endforeach
            </div>
        </div>
        
        <div>
          <label for="price" class="block text-sm font-medium mb-1">Precio por Pieza</label>
          <input id="price" name="price" type="number" step="0.01" min="0" placeholder="Ejemplo: 126.67" class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 placeholder-gray-400 text-base focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent" required />
        </div>

        <div>
          <label for="pieces_per_package" class="block text-sm font-medium mb-1">Piezas por Paquete</label>
          <input id="pieces_per_package" name="pieces_per_package" type="number" min="0" placeholder="Ejemplo: 6" class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 placeholder-gray-400 text-base focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent" required />
        </div>

        <div>
          <label for="pieces_per_box" class="block text-sm font-medium mb-1">Piezas por Empaque</label>
          <input id="pieces_per_box" name="pieces_per_box" type="number" min="0" placeholder="Ejemplo: 48" class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 placeholder-gray-400 text-base focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent" required />
        </div>

        <div>
          <label for="sale_note" class="block text-sm font-medium mb-1">Nota de Venta</label>
          <input id="sale_note" name="sale_note" type="text" placeholder="Ejemplo: Venta en múltiplos de colores surtidos" class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 placeholder-gray-400 text-base focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent" required />
        </div>

        <div>
          <label for="material" class="block text-sm font-medium mb-1">Material</label>
          <input id="material" name="material" type="text" placeholder="Ejemplo: Plástico" class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 placeholder-gray-400 text-base focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent" />
        </div>

        <div>
          <label for="models" class="block text-sm font-medium mb-1">Modelos Disponibles</label>
          <input id="models" name="models" type="number" min="0" placeholder="Ejemplo: 6" class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 placeholder-gray-400 text-base focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent" />
        </div>

        <div>
          <label for="measurements" class="block text-sm font-medium mb-1">Medidas</label>
          <input id="measurements" name="measurements" type="text" placeholder="Ejemplo: 38 x 26.5 cm" class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 placeholder-gray-400 text-base focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent" />
        </div>

        <div>
          <label for="separators" class="block text-sm font-medium mb-1">Número de Separadores</label>
          <input id="separators" name="separators" type="number" min="0" placeholder="Ejemplo: 12" class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 placeholder-gray-400 text-base focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent" />
        </div>

        <div>
          <label for="extra_notes" class="block text-sm font-medium mb-1">Notas Adicionales</label>
          <textarea id="extra_notes" name="extra_notes" rows="3" placeholder="Ejemplo: Incluye tira de pestañas..." class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 placeholder-gray-400 text-base resize-y focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent"></textarea>
        </div>

        <div>
          <label for="weight" class="block text-sm font-medium mb-1">Peso</label>
          <input id="weight" name="weight" type="number" placeholder="Ejemplo: 0.350 g" class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 placeholder-gray-400 text-base focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent" />
        </div>

        <div>
          <label for="barcode" class="block text-sm font-medium mb-1">Código de Barras (número)</label>
          <input id="barcode" name="barcode" type="text" placeholder="Ejemplo: 6956244822127" class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 placeholder-gray-400 text-base focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent" />
        </div>

        <div>
          <label for="sku" class="block text-sm font-medium mb-1">SKU</label>
          <input id="sku" name="sku" type="text" placeholder="Ej: PROD-ROJO-XYZ" class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 px-4 py-3 placeholder-gray-400 text-base focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent" />
        </div>

        <div class="pt-4">
          <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 rounded-xl transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-pink-600 focus:ring-opacity-75">
            Crear Producto
          </button>
        </div>
      </div> </form>
  </div>
</body>
</html>
</x-app-admin>