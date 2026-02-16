<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mi Perfil - Motos DMT</title>
    @vite('resources/scss/app.scss')
    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="antialiased">

    {{-- Reutilizamos el fondo y overlay de tu estética --}}
    <div class="background">
        <div class="background__overlay"></div>
    </div>

    {{-- Header igual al de Checkout/Catálogo --}}
    <header class="header">
        <div class="header__container">
            <a href="{{ url('/') }}" class="logo">
                <div class="logo__icon"><img src="{{ asset('img/logo.png') }}" alt="Logo"></div>
                <div class="logo__text">
                    <div class="logo__text-title">MOTOS DMT</div>
                    <div class="logo__text-subtitle">CENTRAL DE CONTROL</div>
                </div>
            </a>
            <nav class="nav">
                <a href="{{ url('/') }}" class="nav__link">INICIO</a>
                <a href="{{ route('catalogo.index') }}" class="nav__link">CATÁLOGO</a>
                <a href="#" class="nav__link nav__link--active">MI PERFIL</a>
            </nav>
        </div>
    </header>

    <main class="profile-container">
        <div class="checkout__container"> {{-- Reutilizamos el contenedor de checkout por consistencia --}}

            <div class="checkout__header">
                <h1 class="checkout__title">Configuración de Piloto</h1>
                <p class="checkout__subtitle">Gestiona tu cuenta y credenciales de <span class="highlight">Acceso</span>
                </p>
            </div>

            <div class="profile-grid">
                {{-- Sección: Información Personal --}}
                <section class="option-card">
                    <div class="option-card__header">
                        <svg class="option-card__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <h3 class="option-card__title">Información del Perfil</h3>
                    </div>
                    <div class="profile-form-wrapper">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </section>

                {{-- Sección: Seguridad/Password --}}
                <section class="option-card">
                    <div class="option-card__header">
                        <svg class="option-card__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <h3 class="option-card__title">Seguridad de la Cuenta</h3>
                    </div>
                    <div class="profile-form-wrapper">
                        @include('profile.partials.update-password-form')
                    </div>
                </section>

                {{-- Sección: Ubicación --}}
                <section class="option-card">
                    <div class="option-card__header">
                        <svg class="option-card__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <h3 class="option-card__title">Ubicación de Envío</h3>
                    </div>
                    <div class="profile-form-wrapper">
                        @include('profile.partials.update-location-form')
                    </div>
                </section>
                {{-- Sección: Cierre de Sesión --}}
                <section class="option-card option-card--logout">
                    <div class="option-card__header">
                        <svg class="option-card__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <h3 class="option-card__title">Finalizar Sesión</h3>
                    </div>

                    <div class="profile-form-wrapper" style="padding: 20px; text-align: center;">
                        <p style="color: #888; margin-bottom: 20px; font-family: 'Rajdhani';">
                            ¿Has terminado por hoy? Asegura tu cuenta cerrando la sesión antes de bajar de la moto.
                        </p>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn-logout" style="
                background: transparent; 
                border: 2px solid #ffcc00; 
                color: #ffcc00; 
                padding: 12px 30px; 
                font-family: 'Orbitron'; 
                cursor: pointer;
                transition: 0.3s;
                text-transform: uppercase;">
                                CERRAR SESIÓN
                            </button>
                        </form>
                    </div>
                </section>
            </div>

            <div class="checkout__back">
                <a href="{{ url()->previous() }}" class="btn-back">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Volver
                </a>
            </div>
        </div>
    </main>

    <footer class="footer footer--simple">
        <div class="footer__container">
            <span class="footer__copyright">© 2026 Motos DMT. Área de Cliente Privada.</span>
        </div>
    </footer>

</body>

</html>