<x-app-layout>
<div class="max-w-4xl mx-auto p-4 space-y-4">

    <header class="text-pink-600 p-6">
        <h1 class="text-pink-600 text-3xl font-extrabold tracking-wide">Mis compras</h1>
    </header>

    @forelse ($mycompras as $compra)
    <div class="flex items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition duration-300">

        <div class="flex items-start space-x-4">

            <div class="flex-shrink-0 w-16 h-16 bg-gray-100 rounded-md flex items-center justify-center border border-gray-300">
                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>

            <div>
                <div class="flex text-sm text-gray-600 mb-1">
                    <span>Fecha de compra: {{ $compra->created_at->format('d/m/Y H:i') }}</span>
                </div>

                <p class="text-base font-bold text-gray-900 uppercase tracking-wider mb-1">
                    REFERENCIA: {{ $compra->ref }}
                </p>

                <div class="flex items-center text-sm text-gray-500">
                    <span>Estado: {{ ucfirst($compra->status) }}</span>
                </div>

                <div class="flex items-center text-sm text-gray-700 font-semibold">
                    Total: ${{ number_format($compra->total, 2) }}
                </div>
            </div>
        </div>

        <a href="{{ route('compras.productos',  $compra->id) }}"
           class="flex-shrink-0 px-4 py-2 text-sm font-medium text-pink-600 border border-pink-600 rounded-full hover:bg-pink-50 transition duration-150">
            Ver detalle de compra
        </a>

    </div>
    @empty
        <p class="text-center pt-4 text-gray-500 text-sm">No tienes compras registradas.</p>
    @endforelse

    <p class="text-center pt-4 text-gray-500 text-sm">
        Fin de la lista de pedidos.
    </p>

</div>
</x-app-layout>
