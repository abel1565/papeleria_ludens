<nav class="flex justify-center">
    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="bg-pink-600 text-white hover:bg-pink-700 px-8 py-4 rounded-lg text-lg font-semibold transition-colors"
        >
            Ir al Incio
        </a>
    @else
        <a
            href="{{ route('login') }}"
            class="bg-pink-600 text-white hover:bg-pink-700 px-8 py-4 rounded-lg text-lg font-semibold transition-colors"
        >
            Ingresar
        </a>
    @endauth
</nav>
