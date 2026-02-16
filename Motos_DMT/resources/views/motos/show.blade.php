<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $moto->modelo }} - Motos DMT</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/scss/app.scss'])
</head>

<body class="moto-detail-page">

    {{-- Navbar con clases corregidas para el SCSS --}}
    <nav class="navbar">
        <div class="navbar__container">
            <div class="logo">
                <div class="logo__icon">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Motos DMT">
                </div>
                <div class="logo__text">
                    <div class="logo__text-title">MOTOS DMT</div>
                    <div class="logo__text-subtitle">NI UN PELO DE TONTOS</div>
                </div>
            </div>

            <div class="navbar__menu">
                <a href="{{ url('/') }}" class="navbar__link {{ request()->is('/') ? 'navbar__link--active' : '' }}">INICIO</a>
                <a href="{{ route('catalogo.index') }}" class="navbar__link {{ request()->routeIs('catalogo.*') ? 'navbar__link--active' : '' }}">CATÁLOGO</a>
                <a href="{{ url('/nosotros') }}" class="navbar__link {{ request()->is('nosotros') ? 'navbar__link--active' : '' }}">NOSOTROS</a>
            </div>

            <div class="user-section">
                @auth
                    <a href="{{ route('profile.edit') }}" class="user-section__link">MI CUENTA</a>
                @else
                    <a href="{{ route('login') }}" class="user-section__link">LOG IN</a>
                @endauth
                <div class="user-section__divider"></div>
                <div class="user-section__avatar">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
        </div>
    </nav>

    {{-- Contenedor principal que aplica el padding del SCSS --}}
    <main class="detail-container">
        
        {{-- Header del detalle (Título y botón Volver) --}}
        <header class="detail-header">
            <h1 class="detail-header__title">Detalle de <span>Máquina</span></h1>
            <a href="{{ route('catalogo.index') }}" class="btn-back">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Volver al catálogo
            </a>
        </header>

        {{-- Card Principal --}}
        <section class="moto-main-card">
            <div class="moto-main-card__grid">
                <div class="moto-main-card__image-container">
                    @php
                        $src = $moto->imagen;
                        if ($src && !Str::startsWith($src, ['http://', 'https://'])) {
                            $src = asset('storage/' . $src);
                        }
                    @endphp
                    <img src="{{ $src ?? 'https://via.placeholder.com/600x400' }}" alt="{{ $moto->modelo }}">
                </div>

                <div class="moto-main-card__content">
                    <div class="moto-main-card__header">
                        <div>
                            <h2 class="moto-title">{{ $moto->modelo }}</h2>
                            <p class="moto-subtitle">{{ $moto->manufacturer->nombre }} — {{ $moto->category->nombre }}</p>
                        </div>
                        <div class="moto-price">
                            <span class="moto-price__label">Inversión</span>
                            <span class="moto-price__value">{{ number_format($moto->precio, 0, ',', '.') }}€</span>
                        </div>
                    </div>

                    <p class="moto-description">{{ $moto->descripcion }}</p>

                    <div class="moto-specs-grid">
                        <div class="spec-item">
                            <span class="spec-label">AÑO</span>
                            <span class="spec-value">{{ $moto->año }}</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-label">CILINDRADA</span>
                            <span class="spec-value">{{ $moto->cilindrada }} cc</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-label">STOCK</span>
                            <span class="spec-value">{{ $moto->stock }}</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-label">ESTADO</span>
                            <span class="spec-value {{ $moto->disponible ? 'text-success' : 'text-danger' }}">
                                {{ $moto->disponible ? 'Disponible' : 'Agotado' }}
                            </span>
                        </div>
                    </div>

                    <div class="moto-actions">
                        <a href="{{ route('checkout', ['moto_id' => $moto->id]) }}" class="btn-primary">RESERVAR AHORA</a>
                        @auth
                            <a href="{{ route('motos.edit', $moto->id) }}" class="btn-secondary">CONFIGURAR</a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>

        {{-- Grid de información extra --}}
        <div class="detail-extra-grid">
            <section class="extra-card">
                <h3 class="extra-card__title">ACCESORIOS DISPONIBLES</h3>
                <div class="extra-card__list">
                    @forelse($moto->accessories as $acc)
                        <div class="extra-item">
                            <span class="extra-item__name">{{ $acc->nombre }}</span>
                            <span class="extra-item__price">{{ number_format($acc->precio, 2) }}€</span>
                        </div>
                    @empty
                        <p class="empty-text">No hay accesorios específicos para este modelo.</p>
                    @endforelse
                </div>
            </section>

            <section class="extra-card">
                <h3 class="extra-card__title">RESEÑAS DE PILOTOS</h3>
                <div class="extra-card__list">
                    @forelse($moto->reviews as $rev)
                        <div class="review-item">
                            <div class="review-item__header">
                                <strong>{{ $rev->titulo }}</strong>
                                <span class="rating">{{ $rev->rating }}/5</span>
                            </div>
                            <p>{{ $rev->comentario }}</p>
                        </div>
                    @empty
                        <p class="empty-text">Sé el primero en pilotar y opinar sobre esta máquina.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </main>
</body>

</html>