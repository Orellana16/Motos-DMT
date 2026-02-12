<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Motos DMT</title>
    @vite('resources/css/app.css') {{-- Tailwind --}}
</head>
<body class="bg-black text-white">

    <!-- NAVBAR -->
    <header class="bg-black px-10 py-4 flex justify-between items-center">
        
        <nav class="flex space-x-10 font-bold tracking-wider text-lg">
            
            <a href="{{ route('inicio') }}" 
               class="border-b-4 border-red-600 pb-1">
               INICIO
            </a>

            <a href="{{ route('catalogo') }}" 
               class="hover:text-red-500 transition duration-300">
               CATÁLOGO
            </a>

            <a href="{{ route('nosotros') }}" 
               class="hover:text-red-500 transition duration-300">
               SOBRE NOSOTROS
            </a>
        </nav>

        <div>
            <img src="{{ asset('img/user.png') }}" 
                 alt="Usuario" 
                 class="w-9 h-9 invert">
        </div>

    </header>


    <!-- HERO -->
    <section 
        class="relative h-[90vh] flex items-center bg-cover bg-center"
        style="background-image: url('{{ asset('img/fondo.png') }}');">

        <!-- Overlay oscuro -->
        <div class="absolute inset-0 bg-black/50"></div>

        <!-- Contenido -->
        <div class="relative z-10 w-full px-20 flex justify-between items-center">

            <!-- Logo -->
            <div>
                <img src="{{ asset('img/logo.png') }}" 
                     alt="Motos DMT" 
                     class="w-[380px]">
            </div>

            <!-- Botones -->
            <div class="flex flex-col space-y-6">

                <a href="{{ route('catalogo') }}"
                   class="bg-red-700 hover:bg-red-800 transition duration-300
                          text-white font-bold text-xl 
                          px-16 py-4 rounded-full text-center shadow-xl">
                    VER MOTOS
                </a>

                <a href="{{ route('nosotros') }}"
                   class="border-4 border-red-700 text-red-700 
                          hover:bg-red-700 hover:text-white transition duration-300
                          font-bold text-xl 
                          px-16 py-4 rounded-full text-center">
                    MÁS
                </a>

            </div>

        </div>

    </section>

</body>
</html>
