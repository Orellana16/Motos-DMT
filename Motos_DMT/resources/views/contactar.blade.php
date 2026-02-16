<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactar - Motos DMT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/scss/app.scss'])
</head>

<body class="catalogo-page">

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
                    <a href="{{ route('profile.edit') }}">MI CUENTA</a>
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

    <main class="content">
        <header class="main-header">
            <span class="main-header__subtitle">Road to Freedom</span>
            <h1 class="main-header__title">Hablemos <br> <span>Hoy</span></h1>
        </header>

        @if(session('success'))
            <div class="mb-6 bg-white border border-gray-300 rounded-xl px-6 py-4 shadow-sm" style="max-width: 1200px; margin: 0 auto;">
                <p class="font-bold text-black">{{ session('success') }}</p>
            </div>
        @endif

        <section class="search-section">
            <form action="{{ route('contactar.send') }}" method="POST" class="search-box">
                @csrf

                <label for="nombre">Tu nombre</label>
                <div class="search-box__group">
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Ej: Picha">
                </div>
                @error('nombre') <p style="color:#b91c1c;font-weight:700;margin-top:6px;">{{ $message }}</p> @enderror

                <label for="email" style="margin-top:18px;">Tu email</label>
                <div class="search-box__group">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Ej: tu@email.com">
                </div>
                @error('email') <p style="color:#b91c1c;font-weight:700;margin-top:6px;">{{ $message }}</p> @enderror

                <label for="mensaje" style="margin-top:18px;">Mensaje</label>
                <div class="search-box__group">
                    <textarea id="mensaje" name="mensaje" rows="6"
                              style="width:100%;padding:14px;border-radius:14px;border:1px solid #e5e7eb; background: transparent; outline: none;"
                              placeholder="Cuéntanos qué necesitas...">{{ old('mensaje') }}</textarea>
                </div>
                @error('mensaje') <p style="color:#b91c1c;font-weight:700;margin-top:6px;">{{ $message }}</p> @enderror

                <div style="margin-top:18px;">
                    <button type="submit" class="btn-filter">ENVIAR MENSAJE</button>
                </div>
            </form>
        </section>
    </main>

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
