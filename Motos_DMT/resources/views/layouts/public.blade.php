<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Motos DMT')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')
</head>
<body class="@yield('body-class')">
    {{-- Background --}}
    @section('background')
    <div class="background">
        <div class="background__image" style="background-image: url('{{ asset('img/fondo.png') }}');"></div>
        <div class="background__overlay"></div>
    </div>
    @show

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
                <a href="{{ url('/') }}" class="nav__link {{ request()->is('/') || request()->is('inicio') ? 'nav__link--active' : '' }}">INICIO</a>
                <a href="{{ route('catalogo.index') }}" class="nav__link {{ request()->routeIs('catalogo.*') ? 'nav__link--active' : '' }}">CATÁLOGO</a>
                <a href="{{ url('/nosotros') }}" class="nav__link {{ request()->is('nosotros') ? 'nav__link--active' : '' }}">NOSOTROS</a>
            </nav>
            <div class="user-section">
                @auth
                    <a href="{{ route('dashboard') }}">MI CUENTA</a>
                @else
                    <a href="{{ route('login') }}" class="user-section__link">LOG IN</a>
                    @if(Route::has('register'))
                    <a href="{{ route('register') }}" class="user-section__link">REGISTRO</a>
                    @endif
                @endauth
                <div class="user-section__divider"></div>
                <div class="user-section__avatar">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

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
