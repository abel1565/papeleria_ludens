<x-app-layout>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <div class="max-w-2xl w-full bg-white rounded-lg shadow-lg p-8 md:p-12 text-center">
            
            <!-- Ícono de Bolsa con Check -->
            <div class="relative inline-block mb-6">
                <div class="relative">
                    <div class="absolute inset-0 bg-pink-200 rounded-full blur-2xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-pink-600 to-pink-500 p-6 rounded-full inline-block">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                </div>
                <div class="absolute -top-2 -right-2 bg-green-500 rounded-full p-2">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>

            <!-- Título -->
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                ¡Gracias por tu compra!
            </h1>

            <!-- Logo D'novac -->
            <div class="my-8 flex justify-center">
                <img 
                    src="{{ asset('/D´novacLogo.png')}}" 
                    alt="D'novac Logo" 
                    class="w-64 h-auto opacity-90"
                />
            </div>

            <!-- Información de Pago -->
            <div class="bg-blue-50 rounded-lg p-6 mb-8">
                <p class="text-gray-700 text-lg">
                    Muy pronto recibirás información sobre tu pago.
                </p>
                <p class="text-sm text-gray-600 mt-2">
                    Te enviaremos un correo electrónico con los detalles de tu pedido.
                </p>
            </div>

            <!-- Botones de Acción -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('dashboard') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-lg transition-colors gap-2">
                    Volver al inicio
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="{{ route('cliente.compras') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 bg-white hover:bg-blue-50 text-blue-700 font-semibold rounded-lg border-2 border-blue-700 transition-colors">
                    Ver mis compras
                </a>
            </div>

            <!-- Información de Contacto -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-600">
                    ¿Necesitas ayuda? Contáctanos en 
                    <a href="" class="text-pink-600 hover:underline font-medium">
                        soporte@dnovac.com
                    </a>
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
