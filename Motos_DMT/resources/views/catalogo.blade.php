<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo - Motos DMT</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-black">

<div class="min-h-screen bg-gray-100">

    <!-- NAVBAR -->
    <header class="border-b border-gray-300 bg-gray-100">
        <div class="flex items-center justify-between px-10 py-6">

            <!-- Menú -->
            <nav class="flex gap-16 text-lg font-black tracking-wide">

                <a href="{{ route('inicio') }}"
                   class="hover:text-red-700 transition">
                    INICIO
                </a>

                <a href="{{ route('catalogo') }}"
                   class="border-b-4 border-red-700 pb-1">
                    CATÁLOGO
                </a>

                <a href="{{ route('nosotros') }}"
                   class="hover:text-red-700 transition">
                    SOBRE NOSOTROS
                </a>

            </nav>

            <!-- Icono usuario (imagen) -->
            <div class="w-12 h-12 rounded-full border-2 border-black overflow-hidden">
                <img src="{{ asset('img/user.png') }}"
                     alt="Usuario"
                     class="w-full h-full object-cover">
            </div>

        </div>
    </header>


    <!-- CONTENIDO -->
    <div class="px-20 py-16">

        <!-- TÍTULO -->
        <h1 class="text-7xl font-black text-black leading-none mb-16">
            NUESTRAS <br> MOTOS
        </h1>

        <!-- BUSCADOR Y FILTRO -->
        <div class="flex items-end justify-between mb-12">

            <div class="flex items-end gap-4 w-2/3">

                <div class="w-full">
                    <label class="block text-lg font-semibold mb-2">
                        Buscar
                    </label>
                    <input type="text"
                           placeholder="Buscar moto..."
                           class="w-full px-4 py-3 rounded-lg border border-gray-400
                                  focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>

                <!-- Botón buscar -->
                <button class="w-12 h-12 rounded-full border-2 border-red-700 
                               flex items-center justify-center text-red-700 
                               hover:bg-red-700 hover:text-white transition">
                    🔍
                </button>

            </div>

            <!-- Botón filtrar -->
            <button class="bg-red-700 hover:bg-red-800 transition duration-300
                           text-white font-bold text-lg
                           px-12 py-3 rounded-full shadow-md">
                FILTRAR
            </button>

        </div>


        <!-- GRID DE MOTOS -->
        <div class="grid grid-cols-3 gap-10">

            @foreach($motos ?? [] as $moto)
            <div class="bg-white rounded-xl border border-gray-300 shadow-sm overflow-hidden">

                <!-- Imagen -->
                <div class="h-56 bg-gray-200 relative">

                    <!-- Botones editar / eliminar -->
                    <div class="absolute top-4 right-4 flex gap-3">

                        <a href="{{ route('motos.edit', $moto->id) }}"
                           class="w-10 h-10 rounded-full bg-red-700 text-white 
                                  flex items-center justify-center hover:bg-red-800 transition">
                            ✏
                        </a>

                        <form method="POST" action="{{ route('motos.destroy', $moto->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="w-10 h-10 rounded-full bg-red-700 text-white 
                                           flex items-center justify-center hover:bg-red-800 transition">
                                🗑
                            </button>
                        </form>

                    </div>

                    @if($moto->imagen)
                        <img src="{{ asset('storage/'.$moto->imagen) }}"
                             class="w-full h-full object-cover">
                    @endif

                </div>

                <!-- Información -->
                <div class="p-6">

                    <h2 class="text-2xl font-black mb-1">
                        {{ $moto->modelo }}
                        <span class="text-lg font-semibold">
                            {{ $moto->marca }}
                        </span>
                    </h2>

                    <p class="text-gray-700 mb-4">
                        {{ $moto->descripcion }}
                    </p>

                    <p class="text-2xl font-black">
                        ${{ number_format($moto->precio, 2) }}
                    </p>

                </div>

            </div>
            @endforeach

        </div>

    </div>

</div>

</body>
</html>
