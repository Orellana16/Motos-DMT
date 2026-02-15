<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Motos DMT') }}</title>
    @vite(['resources/scss/app.scss'])
</head>

<body class="auth-page">

    {{-- Navbar estilo DMT --}}
    <nav class="navbar">
        <div class="navbar__container">
            <div class="navbar__menu">
                <a href="{{ route('home') }}" class="navbar__link {{ request()->routeIs('home') ? 'navbar__link--active' : '' }}">Inicio</a>
                <a href="{{ route('catalogo.index') }}" class="navbar__link {{ request()->routeIs('catalogo.index') ? 'navbar__link--active' : '' }}">Catálogo</a>
                <a href="{{ route('nosotros') }}" class="navbar__link {{ request()->routeIs('nosotros') ? 'navbar__link--active' : '' }}">Nosotros</a>
                <a href="{{ route('contactar') }}" class="navbar__link {{ request()->routeIs('contactar') ? 'navbar__link--active' : '' }}">Contactar</a>
            </div>

            <div class="navbar__user">
                <img src="{{ asset('img/user.png') }}"
                     onerror="this.src='https://ui-avatars.com/api/?name=DMT&background=b91c1c&color=fff'"
                     alt="User">
            </div>
        </div>
    </nav>

    <main class="auth">
        <section class="auth__card">
            {{ $slot }}
        </section>
    </main>

    <footer class="footer">
        <p>© 2026 MOTOS DMT — POWER & STYLE</p>
    </footer>

</body>
</html>
