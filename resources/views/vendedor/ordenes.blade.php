<x-app-vendedor>
    <div class="max-w-7xl mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold mb-6">Órdenes de mis clientes</h1>

        @if($ordenes->isEmpty())
            <p class="text-gray-500 text-center py-10">No hay órdenes registradas todavía.</p>
        @else
            <div class="overflow-x-auto bg-white rounded-xl shadow">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-100 text-gray-900 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-4 py-3 text-left"># Orden</th>
                            <th class="px-4 py-3 text-left">Cliente</th>
                            <th class="px-4 py-3 text-left">Correo</th>
                            <th class="px-4 py-3 text-left">Fecha</th>
                            <th class="px-4 py-3 text-center">Total</th>
                            <th class="px-4 py-3 text-center">Estado</th> {{-- NUEVO --}}
                            <th class="px-4 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($ordenes as $orden)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-semibold">{{ $orden->ref }}</td>
                                <td class="px-4 py-3">{{ $orden->user->name ?? 'Sin nombre' }}</td>
                                <td class="px-4 py-3">{{ $orden->user->email ?? 'Sin correo' }}</td>
                                <td class="px-4 py-3">{{ $orden->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-3 text-center font-semibold">${{ number_format($orden->total, 2) }}</td>

                                {{-- COLUMNA PARA ACTUALIZAR ESTADO --}}
                                <td class="px-4 py-3 text-center">
                                    <form action="{{ route('vendedor.modificar', $orden->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()"
                                            class="border-gray-300 rounded-lg text-sm py-1 px-2 focus:ring-pink-500 focus:border-pink-500">
                                            @foreach(['pending','paid','shipped','delivered','cancelled'] as $estado)
                                                <option value="{{ $estado }}" {{ $orden->status === $estado ? 'selected' : '' }}>
                                                    {{ ucfirst($estado) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('vendedor.compras', $orden->id) }}"
                                       class="inline-block text-pink-600 px-3 py-1.5 rounded-lg text-xs font-medium">
                                        Ver Detalles
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-vendedor>
