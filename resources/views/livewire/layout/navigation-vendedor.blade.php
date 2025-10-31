<?php
use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>
<div class="w-64 h-screen bg-blue-900 text-white flex flex-col shadow-lg">
    <!-- Logo -->
    <div class="flex items-center justify-center py-6 border-b border-white/20">
        <x-application-logo> <a href=""></a> </x-application-logo>
    </div>

    <!-- Menú -->
    <nav class="flex-1 px-4 py-6 space-y-6 overflow-y-auto">

        <!-- Usuarios -->
        <div>
            <h3 class="text-sm font-semibold text-white uppercase mb-2">Clientes</h3>
            <ul class="space-y-2">
                <li>
                    
                </li>
                <li>
                    <a href="{{route('vendedor.registrer')}}" class="flex items-center space-x-2 p-2 rounded hover:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Crear cliente</span>
                    </a>
                </li>
                
            </ul>
        </div>

        <!-- Productos -->
        <div>
            <h3 class="text-sm font-semibold text-white uppercase mb-2">Ventas</h3>
            <ul class="space-y-2">
                <li>
                </li>
                <li>
                    <a href="{{route('vendedor.cliente')}}" class="flex items-center space-x-2 p-2 rounded hover:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Ventas Pendientes</span>
                    </a>
                </li>
            </ul>
        </div>
        <button wire:click="logout" class="w-full text-start">
          <x-responsive-nav-link>
            {{ __('Log Out') }}
          </x-responsive-nav-link>
        </button>
    </nav>
</div>
