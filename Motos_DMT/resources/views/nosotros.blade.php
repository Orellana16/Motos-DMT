<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros - Motos DMT</title>
    @vite(['resources/css/app.css', 'resources/scss/app.scss'])
</head>

<body class="antialiased selection:bg-red-light selection:text-white">

    <div class="background fixed inset-0 z-[-1]">
        <div class="background__image w-full h-full bg-cover bg-center bg-no-repeat transition-transform duration-700 hover:scale-105"
            style="background-image: url('{{ asset('img/nosotros.png') }}');"></div>
        <div class="background__overlay absolute inset-0 bg-gradient-to-br from-black/90 via-black/70 to-red-900/30">
        </div>
    </div>

    <header class="header sticky top-0 z-50 backdrop-blur-sm bg-black/20">
        <div class="header__container max-w-7xl mx-auto px-6 py-4">
            <a href="{{ url('/') }}"
                class="inline-flex items-center text-white font-medium hover:text-red-light transition-colors group">
                <span class="mr-2 transition-transform group-hover:-translate-x-1">←</span> Volver al inicio
            </a>
        </div>
    </header>

    <section class="hero min-h-[calc(100vh-160px)] flex items-center py-12">
        <div class="hero__container max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">

            <div class="hero__left space-y-8">
                <div>
                    <span class="text-red-light font-bold tracking-widest uppercase text-sm mb-2 block">Nuestra
                        Pasión</span>
                    <h1 class="text-7xl font-black text-white leading-none tracking-tighter">
                        NOS<span class="text-red-light">OTROS</span>
                    </h1>
                </div>

                <div class="hero__description space-y-6 text-lg text-gray-200 leading-relaxed max-w-xl">
                    <p class="border-l-4 border-red-light pl-6 py-2 bg-white/5 rounded-r-lg">
                        En <strong class="text-white">Motos DMT</strong> desarrollamos soluciones enfocadas en la
                        gestión y comercialización de motocicletas, combinando diseño moderno con funcionalidad
                        eficiente.
                    </p>
                    <p class="pl-7">
                        Nuestro objetivo es ofrecer una experiencia intuitiva tanto para administradores como para
                        clientes, priorizando el rendimiento y una estética potente inspirada en el <span
                            class="text-red-light font-semibold italic">estilo de vida biker</span>.
                    </p>
                </div>
            </div>

            <div class="hero__right">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div
                        class="group bg-black/60 backdrop-blur-md border border-white/10 rounded-2xl p-6 transition-all duration-300 hover:border-red-light/50 hover:bg-black/80">
                        <div class="w-12 h-1 bg-red-light mb-4 transition-all duration-300 group-hover:w-full"></div>
                        <h3 class="text-2xl font-black text-white mb-2">Tomás</h3>
                        <p class="text-gray-400 mb-4 text-sm leading-snug">
                            Dev1 - Setup inicial, Auth (Users), CRUD Motos, Vistas, Enum.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="bg-red-light/10 text-red-light px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider">Controllers</span>
                            <span
                                class="bg-red-light/10 text-red-light px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider">Models</span>
                        </div>
                    </div>

                    <div
                        class="group bg-black/60 backdrop-blur-md border border-white/10 rounded-2xl p-6 transition-all duration-300 hover:border-red-light/50 hover:bg-black/80">
                        <div class="w-12 h-1 bg-red-light mb-4 transition-all duration-300 group-hover:w-full"></div>
                        <h3 class="text-2xl font-black text-white mb-2">David</h3>
                        <p class="text-gray-400 mb-4 text-sm leading-snug">
                            Dev3 - Pasarela de Pagos (PayPal), Integración ExchangeAPI, Sistema de Emails, Apoyo al
                            resto de
                            Devs.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="bg-red-light/10 text-red-light px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider">APIs</span>
                            <span
                                class="bg-red-light/10 text-red-light px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider">UI/UX</span>
                            <span
                                class="bg-red-light/10 text-red-light px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider">Controllers</span>
                        </div>
                    </div>

                    <div
                        class="group bg-black/60 backdrop-blur-md border border-white/10 rounded-2xl p-6 transition-all duration-300 hover:border-red-light/50 hover:bg-black/80 sm:col-span-2 md:col-span-1">
                        <div class="w-12 h-1 bg-red-light mb-4 transition-all duration-300 group-hover:w-full"></div>
                        <h3 class="text-2xl font-black text-white mb-2">Marcos</h3>
                        <p class="text-gray-400 mb-4 text-sm leading-snug">
                            Dev2 - Base de datos (Migraciones/Seeders), Relaciones N:M, Filtros y Buscador, Controllers.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="bg-red-light/10 text-red-light px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider">Database</span>
                            <span
                                class="bg-red-light/10 text-red-light px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider">Controllers</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-center p-4">
                        <a href="{{ url('/catalogo') }}"
                            class="group relative overflow-hidden bg-red-light px-8 py-4 rounded-xl text-white font-black uppercase tracking-widest text-sm transition-all duration-300 hover:scale-105 active:scale-95 shadow-[0_0_20px_rgba(239,68,68,0.4)]">
                            <span class="relative z-10 italic">Explorar Motos</span>
                            <div
                                class="absolute inset-0 bg-white/20 translate-y-full transition-transform duration-300 group-hover:translate-y-0">
                            </div>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <footer class="footer border-t border-white/5 bg-black/40 backdrop-blur-md">
        <div
            class="footer__container max-w-7xl mx-auto px-6 py-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <span class="footer__copyright text-gray-500 font-medium text-sm italic">© 2026 Motos <span
                    class="text-red-light font-bold">DMT</span> — Road to Freedom</span>
            <div class="footer__links flex gap-8">
                <a href="#"
                    class="text-gray-400 hover:text-white text-xs uppercase tracking-widest transition-colors">Privacidad</a>
                <a href="#"
                    class="text-gray-400 hover:text-white text-xs uppercase tracking-widest transition-colors">Términos</a>
            </div>
        </div>
    </footer>

</body>

</html>