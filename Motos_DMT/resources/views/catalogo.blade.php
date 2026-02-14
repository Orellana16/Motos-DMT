<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - Motos DMT</title>
    @vite(['resources/scss/app.scss'])
</head>

<body class="catalogo-page">

    <nav class="navbar">
        <div class="navbar__container">
            <div class="navbar__menu">
                <a href="{{ url('/') }}" class="navbar__link">Inicio</a>
                <a href="{{ route('catalogo.index') }}"
                    class="navbar__link {{ request()->routeIs('catalogo.index') ? 'navbar__link--active' : '' }}">Catálogo</a>
                <a href="{{ url('/nosotros') }}" class="navbar__link">Nosotros</a>
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
            <h1 class="main-header__title">Nuestras <br> <span>Bestias</span></h1>
        </header>

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
            <select onchange="window.location.href='/catalogo?sort=' + this.value">
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
                            <a href="{{ url('/motos/' . $moto->id . '/edit') }}" class="action-btn" title="Editar">✏</a>
                            <form method="POST" action="{{ route('motos.destroy', $moto->id) }}"
                                onsubmit="return confirm('¿Seguro que quieres eliminar esta bestia?')">
                                @csrf
                                @method('DELETE')
                                <button class="action-btn action-btn--delete" title="Eliminar">🗑</button>
                            </form>
                        </div>

                        @if($moto->imagen)
                            <img src="{{ $moto->imagen }}" alt="{{ $moto->modelo }}">
                        @else
                            <img src="https://via.placeholder.com/400x300?text=Sin+Imagen" alt="No image">
                        @endif

                        <span class="moto-card__brand">{{ $moto->manufacturer->name ?? 'DMT Custom' }}</span>
                    </div>

                <!-- Información -->
                <div class="p-6">

                    <h2 class="text-2xl font-black mb-1">
                        {{ $moto->modelo }}
                        <span class="text-lg font-semibold">
                            {{ $moto->marca }}
                        </span>
                    </h2>

                    <p class="text-gray-700 mb-4">
                        {{ $moto->descripcion }}
                    </p>

                    <p class="text-2xl font-black">
                        ${{ number_format($moto->precio, 2) }}
                    </p>

                </div>
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