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

        <div class="moto-grid">
            @forelse($motos as $moto)
                <article class="moto-card">
                    <div class="moto-card__image">
                        <div class="moto-card__actions">
                            <a href="{{ route('motos.edit', $moto->id) }}" class="action-btn" title="Editar">✏</a>

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

                    <div class="moto-card__info">
                        <h2 class="moto-card__title">{{ $moto->modelo }}</h2>
                        <p class="moto-card__desc">{{ Str::limit($moto->descripcion, 80) }}</p>
                        <div class="moto-card__footer">
                            <span
                                class="moto-card__price">${{ number_format($moto->precio, 0, ',', '.') }}<small>.00</small></span>
                            <a href="{{ route('motos.show', $moto->id) }}" class="btn-detail">Detalles →</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="no-results">
                    <p>No se encontraron motos en el garaje.</p>
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