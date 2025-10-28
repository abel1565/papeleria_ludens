<?php

use App\Livewire\Actions\Logout;
use App\Models\Categoria;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Prepara los datos que se pasarán a la vista.
     * Carga las categorías y sus subcategorías de forma eficiente.
     */
    public function with(): array
    {
        return [
            'categoriasMenu' => Categoria::with('subcategoria')->get(),
        ];
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-blue-900 border-b border-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1280px] mx-auto flex items-center gap-6 px-4 py-3 flex-wrap justify-between">
      
      <!-- Logo -->
      <div class="shrink-0 flex items-center">
        <a href="{{ route('dashboard') }}" wire:navigate>
          <x-logo class="block h-16 w-16 fill-current" />
        </a>
        <span class="text-[#e6007e] font-bold text-2xl select-none ml-2" style="-webkit-text-stroke:1px white; text-stroke:1px white;">
        </span>
      </div>

      <!-- Barra de búsqueda -->
      <form class="flex flex-1 min-w-[200px] max-w-full sm:max-w-[600px] w-full sm:w-auto mt-2 sm:mt-0 order-3 sm:order-2">
        <label class="sr-only" for="search">Buscar</label>
        <div class="relative w-full">
          <input id="search" type="search" placeholder="Buscar por producto, categoría y más..." class="w-full rounded-md py-2 pl-10 pr-4 text-gray-700 text-sm sm:text-base leading-tight focus:outline-none" />
          <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm sm:text-lg pointer-events-none"></i>
        </div>
      </form>

      <!-- Botón carrito -->
      <a href="{{ route('carrito.carrito') }}" 
         class="relative text-xl sm:text-xl hover:text-pink-400 transition order-2 sm:order-3"
         aria-label="Carrito de compras"> Mi carrito
      </a>
      <a href="{{ route('cliente.compras') }}" 
         class="relative text-xl sm:text-xl hover:text-pink-400 transition order-2 sm:order-3"
         aria-label="Carrito de compras"> Mis compras 
      </a>

      <!-- Dropdown usuario -->
      <div class="flex items-center gap-6 text-white font-semibold text-sm sm:text-base whitespace-nowrap mt-2 sm:mt-0 order-2 sm:order-4">
        <div class="hidden sm:flex sm:items-center sm:ms-6">
          <x-dropdown aling="right" width="48">
            <x-slot name="trigger">
              <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="ms-1">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                  </svg>
                </div>
              </button>
            </x-slot>
            <x-slot name="content">
              <x-dropdown-link :href="route('profile')" wire:navigate>
                {{ __('Profile') }}
              </x-dropdown-link>
              <button wire:click="logout" class="w-full text-start">
                <x-dropdown-link>
                  {{ __('Log Out') }}
                </x-dropdown-link>
              </button>
            </x-slot>
          </x-dropdown>
        </div>
      </div>
    </div>

    <!-- Menú inferior -->
    <div class="flex justify-between h-16">
      <div class="w-full border-b border-gray-300">
        <div class="max-w-[1200px] mx-auto px-4">
          <ul class="flex flex-wrap items-center justify-center gap-4 sm:gap-6 text-black text-base py-3 select-none">
            <li class="flex items-center space-x-2 cursor-pointer whitespace-nowrap text-text-white font-semibold">
              </span><i class="fas fa-sun animate-spin-slow"></i><span class="text-white hover:text-pink-400 ">LO NUEVO</span>
            </li>
            
  
            <li class="flex items-center text-white hover:text-pink-400 space-x-2 cursor-pointer whitespace-nowrap">
              <i class="fas fa-shopping-bag"></i><span>QUIERO COMPRAR</span>
            </li>
            <li class="relative group cursor-pointer font-semibold whitespace-nowrap">
              <div class="flex items-center gap-1">
                <i class="fas fa-tag text-white"></i><span class="text-white hover:text-pink-400">PRODUCTOS</span><i class="fas fa-chevron-down text-sm"></i>
              </div>
              <div class="absolute top-[calc(100%+8px)] left-1/2 -translate-x-1/2 w-[calc(100vw-2rem)] sm:w-[1200px] bg-gray-100 border border-gray-200 shadow-xl rounded-lg overflow-hidden opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-opacity duration-200 z-[100]">
                <div class="grid grid-cols-1 sm:grid-cols-5 divide-y sm:divide-y-0 sm:divide-x divide-gray-200">
                  @foreach ($categoriasMenu as $categoria)
                    <section class="px-6 py-6 flex flex-col items-center bg-white">
                      <div class="flex items-center gap-2 mb-3 text-gray-700">
                        <i class="{{ $categoria->icono ?? 'fas fa-pencil-alt' }}"></i>
                        <h3 class="font-semibold text-base">{{ $categoria->categoria }}</h3>
                      </div>
                      <ul class="text-pink-600 text-lg leading-7 text-center space-y-2">
                        @foreach ($categoria->subcategoria as $subcategoria)
                          <li>
                            <a href="{{ route('productos.categoria', $subcategoria->id) }}" class="hover:underline">{{ $subcategoria->subcategoria }}</a>
                          </li>
                        @endforeach
                      </ul>
                    </section>
                  @endforeach
                </div>
              </div>
            </li>
            <li class="flex items-center space-x-2 text-white hover:text-pink-400 cursor-pointer whitespace-nowrap">
              <i class="fas fa-phone"></i><span>CONTACTO</span>
            </li>
            <li class="flex items-center space-x-2 text-white hover:text-pink-400  cursor-pointer whitespace-nowrap">
              <i class="fas fa-phone"></i><span>COMO COMPRAR</span>
            </li>
          </ul>
        </div>
      </div>

      <!-- Menú hamburguesa móvil -->
      <div class="-me-2 flex items-center sm:hidden">
        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Menú móvil desplegable -->
  <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="pt-4 pb-1 border-t border-gray-200">
      <div class="px-4">
        <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
        <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
      </div>

      <div class="mt-3 space-y-1">
        <x-responsive-nav-link :href="route('profile')" wire:navigate>
          {{ __('admin') }}
        </x-responsive-nav-link>
        <button wire:click="logout" class="w-full text-start">
          <x-responsive-nav-link>
            {{ __('Log Out') }}
          </x-responsive-nav-link>
        </button>
      </div>
    </div>
  </div>
</nav>
