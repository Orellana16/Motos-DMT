<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nosotros - Motos DMT</title>
    @vite('resources/css/app.css')
</head>
<body>

<!-- BACKGROUND -->
<div class="background">
    <div class="background__image" style="background-image: url('{{ asset('img/nosotros.png') }}');"></div>
    <div class="background__overlay"></div>
</div>

<!-- HEADER -->
<header class="header">
    <div class="header__container">
        <a href="{{ route('inicio') }}" class="text-white font-semibold hover:text-red-light transition">
            ← Volver
        </a>
    </div>
</header>

<!-- HERO / CONTENIDO PRINCIPAL -->
<section class="hero">
    <div class="hero__container">

        <!-- LADO IZQUIERDO: Imagen (ya en background) -->
        <div class="hero__left">
            <h1 class="text-6xl font-black mb-6 text-red-light">NOSOTROS</h1>
            <div class="hero__description">
                <p class="mb-4">
                    En Motos DMT desarrollamos soluciones enfocadas en la gestión 
                    y comercialización de motocicletas, combinando diseño moderno 
                    con funcionalidad eficiente.
                </p>
                <p>
                    Nuestro objetivo es ofrecer una experiencia intuitiva tanto 
                    para administradores como para clientes, priorizando rendimiento,
                    claridad visual y una estética potente inspirada en el mundo biker.
                </p>
            </div>
        </div>

        <!-- LADO DERECHO: Desarrolladores -->
        <div class="hero__right">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Dev 1 -->
                <div class="bg-black bg-opacity-70 rounded-xl shadow-md p-6">
                    <h3 class="text-2xl font-bold mb-2 text-white">Marco</h3>
                    <p class="text-gray-300 mb-2 text-sm">
                        Especialista en backend y bases de datos. 
                        Encargado de la arquitectura del sistema y lógica de negocio.
                    </p>
                    <span class="text-red-light font-semibold text-sm">
                        Laravel • MySQL • API REST
                    </span>
                </div>

                <!-- Dev 2 -->
                <div class="bg-black bg-opacity-70 rounded-xl shadow-md p-6">
                    <h3 class="text-2xl font-bold mb-2 text-white">David</h3>
                    <p class="text-gray-300 mb-2 text-sm">
                        Responsable del diseño frontend y experiencia de usuario,
                        asegurando coherencia visual y estilo moderno.
                    </p>
                    <span class="text-red-light font-semibold text-sm">
                        Tailwind • UI/UX • Diseño Web
                    </span>
                </div>

                <!-- Dev 3 -->
                <div class="bg-black bg-opacity-70 rounded-xl shadow-md p-6">
                    <h3 class="text-2xl font-bold mb-2 text-white">Tomás</h3>
                    <p class="text-gray-300 mb-2 text-sm">
                        Especialista en backend y bases de datos. 
                        Encargado de la arquitectura del sistema y lógica de negocio.
                    </p>
                    <span class="text-red-light font-semibold text-sm">
                        Laravel • MySQL • API REST
                    </span>
                </div>

            </div>

            <!-- Botón -->
            <div class="mt-8 flex justify-center">
                <a href="{{ route('catalogo') }}"
                   class="bg-red-light hover:bg-red-700 transition duration-300
                          text-white font-bold text-lg
                          px-10 py-3 rounded-lg shadow-md">
                    Ver catálogo
                </a>
            </div>
        </div>

    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer__container">
        <span class="footer__copyright">© 2026 Motos DMT</span>
        <div class="footer__links">
            <a href="#" class="footer__link">Política de privacidad</a>
            <a href="#" class="footer__link">Términos de servicio</a>
        </div>
    </div>
</footer>

</body>
</html>
