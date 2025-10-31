<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>D'novac - Bienvenido</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <!-- El bloque de navegación superior ha sido eliminado, ya que se movió al cuerpo principal -->

        <!-- Contenedor principal con diseño dividido -->
        <div class="flex min-h-screen">
            <!-- Lado izquierdo - Fondo blanco con logo -->
            <div class="flex flex-1 items-center justify-center bg-white">
                <div class="p-8">
                    <img 
                        src="{{ asset('/D´novacLogo.png')}}" 
                        alt="D'novac Logo" 
                        class="w-80 h-auto opacity-90"
                    />
                </div>
            </div>

            <!-- Lado derecho - Fondo azul con contenido -->
            <div class="flex flex-1 items-center justify-center bg-blue-600">
                <div class="text-center px-8">
                    <h1 class="mb-6 text-5xl font-bold text-white">
                        Bienvenido a D'novac
                    </h1>
                    <p class="text-xl text-white/90 mb-8 max-w-md">
                        Tu aliado en productos de papelería y oficina
                    </p>

                    <!-- Nueva sección de navegación principal con Livewire -->
                    @if (Route::has('login'))
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">

                            <livewire:welcome.navigation />
                        </div>
                    @endif