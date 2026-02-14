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
                    class="navbar__link {{ request()->routeIs('catalogo.index') ? 'navbar__link--active' : '' }}">
                    Catálogo
                </a>
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

        {{-- Flash message --}}
        @if(session('success'))
            <div class="mb-6 bg-white border border-gray-300 rounded-xl px-6 py-4 shadow-sm">
                <p class="font-bold text-black">{{ session('success') }}</p>
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
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Precio más alto</option>
                <option value="year_desc" {{ request('sort') == 'year_desc' ? 'selected' : '' }}>Más nuevas (Año)</option>
            </select>
        </div>

        <div class="moto-grid">
            @forelse($motos as $moto)
                <article class="moto-card">
                    <div class="moto-card__image">
                        <div class="moto-card__actions">
                            @auth
                                <a href="{{ route('motos.admin.edit', $moto->id) }}" class="action-btn" title="Editar">✏</a>

                                <form method="POST" action="{{ route('motos.admin.destroy', $moto->id) }}"
                                    onsubmit="return confirm('¿Seguro que quieres eliminar esta bestia?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn action-btn--delete" title="Eliminar">🗑</button>
                                </form>
                            @endauth

                        </div>

                        @php
                            // Imagen consistente:
                            // - si ya es URL absoluta (http/https), úsala tal cual
                            // - si es ruta de storage (motos/xxx.jpg), usa asset('storage/...')
                            $img = null;
                            if (!empty($moto->imagen)) {
                                $img = str_starts_with($moto->imagen, 'http://') || str_starts_with($moto->imagen, 'https://')
                                    ? $moto->imagen
                                    : asset('storage/' . ltrim($moto->imagen, '/'));
                            }
                        @endphp

                        @if($img)
                            <img src="{{ $img }}" alt="{{ $moto->modelo }}">
                        @else
                            <img src="https://via.placeholder.com/400x300?text=Sin+Imagen" alt="No image">
                        @endif

                        <span class="moto-card__brand">
                            {{ optional($moto->manufacturer)->nombre ?? 'DMT Custom' }}
                        </span>
                    </div>

                    <!-- Información -->
                    <div class="p-6">
                        <h2 class="text-2xl font-black mb-1">
                            {{ $moto->modelo }}
                            <span class="text-lg font-semibold">
                                {{ optional($moto->manufacturer)->nombre ?? '' }}
                            </span>
                        </h2>

                        <p class="text-gray-700 mb-4">
                            {{ $moto->descripcion ?? '' }}
                        </p>

                        <p class="text-2xl font-black">
                            ${{ number_format($moto->precio, 2) }}
                        </p>

                        {{-- CTA Detalle (si ya tienes la ruta web de detalle) --}}
                        @if(Route::has('motos.show'))
                            <a href="{{ route('motos.show', $moto->id) }}" class="btn-filter" style="display:inline-block; margin-top: 14px;">
                                VER DETALLES
                            </a>
                        @endif
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
