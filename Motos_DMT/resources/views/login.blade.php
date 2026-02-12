<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión - Motos DMT</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-black">

<div class="min-h-screen flex">

    <!-- LADO IZQUIERDO -->
    <div class="w-1/2 bg-gray-100 flex flex-col">

        <!-- Volver -->
        <div class="px-10 py-6 border-b border-gray-300">
            <a href="{{ route('inicio') }}" 
               class="text-gray-700 font-semibold hover:text-black transition">
                ← Volver
            </a>
        </div>

        <!-- Contenido formulario -->
        <div class="flex-1 flex flex-col justify-center px-28">

            <h1 class="text-6xl font-black text-black leading-tight mb-16">
                INICIA <br> SESIÓN
            </h1>

            <form method="POST" action="{{ route('login') }}" class="space-y-8">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-lg font-semibold text-black mb-2">
                        Correo electrónico
                    </label>
                    <input type="email" 
                           name="email"
                           required
                           class="w-full px-4 py-3 rounded-lg border border-gray-400 
                                  focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-lg font-semibold text-black mb-2">
                        Contraseña
                    </label>

                    <div class="relative">
                        <input type="password" 
                               name="password"
                               required
                               class="w-full px-4 py-3 rounded-lg border border-gray-400 
                                      focus:outline-none focus:ring-2 focus:ring-red-600">

                        <!-- Icono ojo -->
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 cursor-pointer text-gray-600">
                            👁
                        </span>
                    </div>
                </div>

                <!-- Olvidaste contraseña -->
                <div>
                    <a href="{{ route('password.request') }}" 
                       class="text-red-700 font-semibold hover:underline">
                        ¿Has olvidado tu contraseña?
                    </a>
                </div>

                <!-- Botón -->
                <div>
                    <button type="submit"
                        class="bg-red-700 hover:bg-red-800 transition duration-300
                               text-white font-bold text-lg
                               px-10 py-3 rounded-lg shadow-md">
                        Iniciar sesión
                    </button>
                </div>

            </form>
        </div>

    </div>


    <!-- LADO DERECHO (IMAGEN) -->
    <div class="w-1/2 bg-cover bg-center"
         style="background-image: url('{{ asset('img/login.png') }}');">
    </div>

</div>

</body>
</html>
