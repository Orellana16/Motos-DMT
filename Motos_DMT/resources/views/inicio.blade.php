<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Motos DMT</title>
    @vite('resources/scss/app.scss')

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="no-scroll">

    {{-- Fondo --}}
    <div class="background">
        <div class="background__image" style="background-image: url('{{ asset('img/fondo.png') }}');"></div>
        <div class="background__overlay"></div>
    </div>

    {{-- Header --}}
    <header class="header">
        <div class="header__container">

            <div class="logo">
                <div class="logo__icon"><img src="{{ asset('img/logo.png') }}" alt="Logo Motos DMT"></div>
                <div class="logo__text">
                    <div class="logo__text-title">MOTOS DMT</div>
                    <div class="logo__text-subtitle">NI UN PELO DE TONTOS</div>
                </div>
            </div>

            <nav class="nav">
                <a href="{{ url('/') }}" class="nav__link nav__link--active">INICIO</a>
                <a href="#" class="nav__link">CATÁLOGO</a>
                <a href="#" class="nav__link">NOSOTROS</a>
            </nav>

            <div class="user-section">
                <a href="#" class="user-section__link">Iniciar Sesión</a>
                <div class="user-section__divider"></div>
                <div class="user-section__avatar">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>

        </div>
    </header>

    {{-- Hero --}}
    <main class="hero">
        <div class="hero__container">

            <div class="hero__left">

                <div class="hero-image">
                    <img src="{{ asset('img/logo.png') }}" alt="Motos DMT" class="hero-image__img">
                </div>

                <p class="hero__description">
                    Descubre la <span class="highlight">potencia</span> y el
                    <span class="highlight">diseño</span> que definen a las mejores máquinas sobre dos ruedas.
                </p>

                <div class="stats">
                    <div class="stats__item">
                        <div class="stats__value">150+</div>
                        <div class="stats__label">Modelos</div>
                    </div>
                    <div class="stats__divider"></div>
                    <div class="stats__item">
                        <div class="stats__value">50+</div>
                        <div class="stats__label">Marcas</div>
                    </div>
                    <div class="stats__divider"></div>
                    <div class="stats__item">
                        <div class="stats__value">10K+</div>
                        <div class="stats__label">Clientes</div>
                    </div>
                </div>

            </div>

            <div class="hero__right">

                <a href="#" class="btn btn--primary">
                    <span>VER MOTOS</span>
                    <svg class="btn__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>

                <a href="#" class="btn btn--secondary">
                    <span>CONTACTAR</span>
                    <svg class="btn__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                </a>

                <div class="secondary-links">
                    <a href="#" class="secondary-links__link">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Financiación
                    </a>
                    <span class="secondary-links__separator">•</span>
                    <a href="#" class="secondary-links__link">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Garantía
                    </a>
                </div>

                <div class="social">
                    <a href="#" class="social__link">
                        <svg fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                        </svg>
                    </a>
                    <a href="#" class="social__link">
                        <svg fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                    <a href="#" class="social__link">
                        <svg fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                        </svg>
                    </a>
                </div>

            </div>

        </div>
    </main>

    {{-- Footer --}}
    <footer class="footer">
        <div class="footer__container">
            <span class="footer__copyright">© 2026 Motos DMT. Todos los derechos reservados.</span>
            <div class="footer__links">
                <a href="#" class="footer__link">Términos</a>
                <a href="#" class="footer__link">Privacidad</a>
                <a href="#" class="footer__link">Cookies</a>
            </div>
        </div>
    </footer>

</body>

</html>