<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactar - Motos DMT</title>
    @vite(['resources/scss/app.scss'])
</head>

<body class="catalogo-page">

    <nav class="navbar">
        <div class="navbar__container">
            <div class="navbar__menu">
                <a href="{{ route('inicio') }}" class="navbar__link">Inicio</a>
                <a href="{{ route('catalogo.index') }}"
                   class="navbar__link {{ request()->routeIs('catalogo.*') ? 'navbar__link--active' : '' }}">
                    Catálogo
                </a>
                <a href="{{ route('nosotros') }}" class="navbar__link">Nosotros</a>
                <a href="{{ route('contactar') }}"
                   class="navbar__link {{ request()->routeIs('contactar') ? 'navbar__link--active' : '' }}">
                    Contactar
                </a>
            </div>
            <div class="navbar__user">
                <img src="{{ asset('img/user.png') }}"
                     onerror="this.src='https://ui-avatars.com/api/?name=Admin&background=b91c1c&color=fff'" alt="User">
            </div>
        </div>
    </nav>

    <main class="content">
        <header class="main-header">
            <span class="main-header__subtitle">Road to Freedom</span>
            <h1 class="main-header__title">Hablemos <br> <span>Hoy</span></h1>
        </header>

        @if(session('success'))
            <div class="mb-6 bg-white border border-gray-300 rounded-xl px-6 py-4 shadow-sm">
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
                              style="width:100%;padding:14px;border-radius:14px;border:1px solid #e5e7eb;"
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
        <p>© 2026 MOTOS DMT — POWER & STYLE</p>
    </footer>

</body>
</html>
