<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Banner -->
        <div class="w-full overflow-hidden rounded-lg mb-10">
            <img src="{{ asset('/CompraTusFavoritos.png')}}" alt="Banner de Contacto" class="w-full h-auto object-cover">
        </div>

        <!-- Grid de dos columnas -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Sección Enlaces Mercado Libre -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border-2 ">
                <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Enlaces Mercado Libre</h2>
                
                <div class="flex flex-col space-y-4">
                    <!-- Link 1 Mercado Libre -->
                    <a href="https://www.mercadolibre.com.mx/pagina/dnovacpapelera#from=share_eshop" 
                       target="_blank"
                       class="bg-gradient-to-r from-yellow-300 to-yellow-400 hover:from-yellow-400 hover:to-yellow-500 flex items-center justify-center gap-3 px-6 py-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        <img src="{{ asset('/mercadolibre.svg') }}" 
                             alt="Mercado Libre"
                             class="h-8 w-auto">
                        <span class="font-semibold text-gray-800">D'novac Papelera</span>
                    </a>

                    <!-- Link 2 Mercado Libre -->
                    <a href="https://www.mercadolibre.com.mx/pagina/novedacticfabricantes" 
                       target="_blank"
                       class="bg-gradient-to-r from-yellow-300 to-yellow-400 hover:from-yellow-400 hover:to-yellow-500 flex items-center justify-center gap-3 px-6 py-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        <img src="{{ asset('/mercadolibre.svg') }}" 
                             alt="Mercado Libre"
                             class="h-8 w-auto">
                        <span class="font-semibold text-gray-800">Novedactic Fabricantes</span>
                    </a>

   
                </div>
            </div>

            <!-- Sección Catálogo Mayoreo -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border-2 ">
                <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Catálogo Mayoreo</h2>
                
                <div class="flex flex-col items-center justify-center space-y-6 h-full min-h-[300px]">
                    <!-- Icono decorativo -->
                    <div class="bg-pink-500  p-6 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    
                    <p class="text-xl text-gray-700 text-center font-medium">Descarga nuestro catálogo de productos al mayoreo</p>
                    
                    <!-- Botón de descarga -->
                    <a href="{{ asset('/catalogo-mayoreo.pdf') }}" 
                       download
                       class="bg-pink-600 hover:from-blue-700 hover:to-pink-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Descargar Catálogo PDF
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
