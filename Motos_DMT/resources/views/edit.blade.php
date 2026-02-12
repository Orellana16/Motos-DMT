<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Moto - Motos DMT</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-black">

<div class="min-h-screen flex">

    <!-- LADO IZQUIERDO (IMAGEN) -->
    <div class="w-1/3 bg-cover bg-center"
         style="background-image: url('{{ asset('img/edit.png') }}');">
    </div>


    <!-- LADO DERECHO (FORMULARIO) -->
    <div class="w-2/3 bg-gray-100 flex flex-col">

        <!-- Volver -->
        <div class="px-10 py-6 border-b border-gray-300">
            <a href="{{ route('catalogo') }}" 
               class="text-gray-700 font-semibold hover:text-black transition">
                ← Volver
            </a>
        </div>

        <!-- Contenido -->
        <div class="flex-1 px-24 py-16">

            <h1 class="text-6xl font-black text-black mb-16 text-right">
                EDITAR
            </h1>

            <form method="POST" action="{{ route('motos.update', $moto->id) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-x-12 gap-y-8">

                    <!-- ID Fabricador -->
                    <div>
                        <label class="block font-semibold text-lg mb-2">ID Fabricador</label>
                        <select name="fabricador_id"
                            class="w-full px-4 py-3 rounded-lg border border-gray-400 focus:ring-2 focus:ring-red-600">
                            @foreach($fabricadores as $fabricador)
                                <option value="{{ $fabricador->id }}"
                                    {{ $moto->fabricador_id == $fabricador->id ? 'selected' : '' }}>
                                    {{ $fabricador->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- ID Categoría -->
                    <div>
                        <label class="block font-semibold text-lg mb-2">ID Categoría</label>
                        <select name="categoria_id"
                            class="w-full px-4 py-3 rounded-lg border border-gray-400 focus:ring-2 focus:ring-red-600">
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ $moto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Modelo -->
                    <div>
                        <label class="block font-semibold text-lg mb-2">Modelo</label>
                        <input type="text" name="modelo" value="{{ $moto->modelo }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-400 focus:ring-2 focus:ring-red-600">
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label class="block font-semibold text-lg mb-2">Descripción</label>
                        <input type="text" name="descripcion" value="{{ $moto->descripcion }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-400 focus:ring-2 focus:ring-red-600">
                    </div>

                    <!-- Año -->
                    <div>
                        <label class="block font-semibold text-lg mb-2">Año</label>
                        <input type="number" name="anio" value="{{ $moto->anio }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-400 focus:ring-2 focus:ring-red-600">
                    </div>

                    <!-- Cilindrada -->
                    <div>
                        <label class="block font-semibold text-lg mb-2">Cilindrada</label>
                        <input type="number" name="cilindrada" value="{{ $moto->cilindrada }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-400 focus:ring-2 focus:ring-red-600">
                    </div>

                    <!-- Precio -->
                    <div>
                        <label class="block font-semibold text-lg mb-2">Precio</label>
                        <input type="number" step="0.01" name="precio" value="{{ $moto->precio }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-400 focus:ring-2 focus:ring-red-600">
                    </div>

                    <!-- Stock -->
                    <div>
                        <label class="block font-semibold text-lg mb-2">Stock</label>
                        <input type="number" name="stock" value="{{ $moto->stock }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-400 focus:ring-2 focus:ring-red-600">
                    </div>

                    <!-- Disponible -->
                    <div>
                        <label class="block font-semibold text-lg mb-2">Disponible</label>
                        <select name="disponible"
                            class="w-full px-4 py-3 rounded-lg border border-gray-400 focus:ring-2 focus:ring-red-600">
                            <option value="1" {{ $moto->disponible ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ !$moto->disponible ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                </div>

                <!-- Botón -->
                <div class="mt-16 flex justify-center">
                    <button type="submit"
                        class="bg-red-700 hover:bg-red-800 transition duration-300
                               text-white font-bold text-lg
                               px-16 py-4 rounded-lg shadow-md">
                        Guardar
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>
