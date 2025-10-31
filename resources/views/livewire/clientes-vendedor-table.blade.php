<x-app-vendedor>
    <div class="max-w-7xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Mis Clientes</h1>

        {{-- Aquí renderizamos el componente PowerGrid --}}
        @livewire('clientes-vendedor-table')
    </div>
</x-app-vendedor>