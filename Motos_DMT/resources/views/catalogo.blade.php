<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - Motos DMT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
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
                <a href="{{ url('/') }}"
                    class="nav__link {{ request()->is('/') || request()->is('inicio') ? 'nav__link--active' : '' }}">INICIO</a>
                <a href="{{ route('catalogo.index') }}"
                    class="nav__link {{ request()->routeIs('catalogo.*') ? 'nav__link--active' : '' }}">CATÁLOGO</a>
                <a href="{{ url('/nosotros') }}"
                    class="nav__link {{ request()->is('nosotros') ? 'nav__link--active' : '' }}">NOSOTROS</a>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
        </div>
    </header>

    <main class="content">
        <header class="main-header">
            <span class="main-header__subtitle">Road to Freedom</span>
            <h1 class="main-header__title">Nuestras <br> <span>Bestias</span></h1>
        </header>

        @if(request()->get('success'))
            <div class="alert-success-custom" style="margin-bottom: 2rem;">
                <div class="alert-content"
                    style="background: rgba(0, 255, 136, 0.1); border: 1px solid #00ff88; padding: 1.5rem; border-radius: 8px; display: flex; align-items: center; gap: 1rem; color: #00ff88; font-family: 'Rajdhani', sans-serif;">
                    <svg class="icon" style="width: 32px; height: 32px;" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <strong style="font-family: 'Orbitron', sans-serif; display: block; font-size: 1.2rem;">¡OPERACIÓN
                            COMPLETADA!</strong>
                        <p style="margin: 0; opacity: 0.9;">Tu moto ya está gestionada correctamente. "Ni un pelo de tonto",
                            has hecho una gran compra.</p>
                    </div>
                </div>
            </div>
        @endif

        <section class="search-section">
            <form action="{{ route('catalogo.index') }}" method="GET" class="search-box">
                <label for="search">¿Qué buscas exactamente?</label>
                <div class="search-box__group">
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        placeholder="Ej: Sportster, Naked, Custom...">
                    <button type="submit" class="btn-search">🔍</button>
                </div>
            </form>

            <a href="{{ route('catalogo.index') }}" class="btn-filter">LIMPIAR FILTROS</a>
        </section>

        <div class="sort-box">
            <label>Ordenar por:</label>
            <select onchange="window.location.href='{{ url('/catalogo') }}?sort=' + this.value">
                <option value="id_asc" {{ request('sort') == 'id_asc' ? 'selected' : '' }}>Por defecto</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Precio más bajo</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Precio más alto
                </option>
                <option value="year_desc" {{ request('sort') == 'year_desc' ? 'selected' : '' }}>Más nuevas (Año)</option>
            </select>
        </div>

        <div class="moto-grid">
            @forelse($motos as $moto)
                <article class="moto-card">
                    <div class="moto-card__image">
                        <div class="moto-card__actions">
                            @auth
                                {{-- Usamos check() por seguridad y comparamos el rol --}}
                                @if(Auth::user()?->rol === \App\Enums\UserRol::ADMIN)
                                    <div class="admin-controls">
                                        <a href="{{ route('motos.edit', $moto->id) }}" class="action-btn" title="Edit">✏</a>

                                        <form method="POST" action="{{ route('motos.destroy', $moto->id) }}" style="display:inline;"
                                            onsubmit="return confirm('¿Eliminar esta bestia?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn action-btn--delete">🗑</button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>

                        @if($moto->imagen)
                            <img src="{{ $moto->imagen }}" alt="{{ $moto->modelo }}">
                        @else
                            <img src="https://via.placeholder.com/400x300?text=Sin+Imagen" alt="No image">
                        @endif

                        <span class="moto-card__brand">{{ $moto->manufacturer->nombre ?? 'DMT Custom' }}</span>
                    </div>

                    <!-- Información -->
                    <div class="moto-card__info">
                        <h2 class="moto-card__title">
                            {{ $moto->modelo }}
                            <span>
                                {{ optional($moto->manufacturer)->nombre ?? '' }}
                            </span>
                        </h2>

                        <p class="moto-card__desc">
                            {{ $moto->descripcion ?? '' }}
                        </p>

                        <div class="moto-card__footer">
                            <div class="moto-card__price">
                                ${{ number_format($moto->precio, 2) }}
                            </div>

                            @if(Route::has('motos.show'))
                                <a href="{{ route('motos.show', $moto->id) }}" class="btn-filter">
                                    VER DETALLES
                                </a>
                            @endif
                        </div>
                    </div>

                </article>
            @empty
                <p>No hay motos disponibles.</p>
            @endforelse
        </div>

        <div class="pagination-container">
            {{ $motos->onEachSide(10)->links() }}
        </div>
    </main>

    <footer class="footer">
        <p>© 2026 MOTOS DMT — POWER & STYLE</p>
    </footer>

</body>

</html>