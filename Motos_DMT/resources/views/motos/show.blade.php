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

    <nav class="navbar">
        <div class="navbar__container">
            <div class="navbar__menu">
                <a href="{{ url('/') }}" class="navbar__link">Inicio</a>
                <a href="{{ route('catalogo.index') }}" class="navbar__link">Catálogo</a>
                <a href="{{ url('/nosotros') }}" class="navbar__link">Nosotros</a>
            </div>
        </div>
    </nav>

    <main class="detail-container">
        <header class="detail-header">
            <h1 class="detail-header__title">DETALLE <span>MOTO</span></h1>
            <a href="{{ route('catalogo.index') }}" class="btn-back">← VOLVER</a>
        </header>

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
                            <p class="moto-subtitle">{{ $moto->manufacturer->nombre }} | {{ $moto->category->nombre }}</p>
                        </div>
                        <div class="moto-price">
                            <span class="moto-price__label">PRECIO</span>
                            <span class="moto-price__value">{{ number_format($moto->precio, 0, ',', '.') }}€</span>
                        </div>
                    </div>

                    <p class="moto-description">{{ $moto->descripcion }}</p>

                    <div class="moto-specs-grid">
                        <div class="spec-item"><span class="spec-label">AÑO</span><span class="spec-value">{{ $moto->año }}</span></div>
                        <div class="spec-item"><span class="spec-label">CILINDRADA</span><span class="spec-value">{{ $moto->cilindrada }} cc</span></div>
                        <div class="spec-item"><span class="spec-label">STOCK</span><span class="spec-value">{{ $moto->stock }}</span></div>
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
                            <a href="{{ route('motos.edit', $moto->id) }}" class="btn-secondary">EDITAR</a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>

        <div class="detail-extra-grid">
            <section class="extra-card">
                <h3 class="extra-card__title">ACCESORIOS</h3>
                <div class="extra-card__list">
                    @forelse($moto->accessories as $acc)
                        <div class="extra-item">
                            <span class="extra-item__name">{{ $acc->nombre }}</span>
                            <span class="extra-item__price">{{ number_format($acc->precio, 2) }}€</span>
                        </div>
                    @empty
                        <p class="empty-text">Sin accesorios.</p>
                    @endforelse
                </div>
            </section>

            <section class="extra-card">
                <h3 class="extra-card__title">RESEÑAS</h3>
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
                        <p class="empty-text">Sin reseñas aún.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </main>
</body>
</html>