<x-app-vendedor>
<div class="bg-white shadow-md rounded-lg p-6 w-full">
        <h2 class="text-xl font-bold mb-4">Crear Cliente</h2>

        <form method="POST" action="{{ route('vendedor.store') }}">
            @csrf

            <!-- Nombre -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="name" id="name" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm" 
                       required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Correo</label>
                <input type="email" name="email" id="email" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm" 
                       required>
            </div>

            <!-- Teléfono -->
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input type="text" name="phone" id="phone" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm" 
                       required>
            </div>

            <!-- Rol -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Rol a Asignar</label>
                <select id="role" name="role"
                        class="w-full rounded-xl border border-gray-300 text-gray-900 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" required>
                    <option value="" disabled selected>Selecciona un rol</option>
                    @foreach($rolesDisponibles as $rol)
                        <option value="{{ $rol }}">{{ ucfirst($rol) }}</option>
                    @endforeach
                </select>
            </div>


            <!-- Botón -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="px-4 py-2 bg-blue-700 text-white text-sm font-medium rounded-md hover:bg-pink-500">
                    Guardar
                </button>
            </div>
        </form>
    </div>


</x-app-vendedor>