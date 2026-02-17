<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Finalizar Operación - Motos DMT</title>
    @vite('resources/scss/app.scss')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
</head>

<body>

    {{-- Fondo --}}
    <div class="background">
        <div class="background__overlay"></div>
    </div>

    {{-- Header --}}
    <header class="header">
        <div class="header__container">
            <a href="{{ url('/') }}" class="logo">
                <div class="logo__icon"><img src="{{ asset('img/logo.png') }}" alt="Logo Motos DMT"></div>
                <div class="logo__text">
                    <div class="logo__text-title">MOTOS DMT</div>
                    <div class="logo__text-subtitle">NI UN PELO DE TONTOS</div>
                </div>
            </a>

            <nav class="nav">
                <a href="{{ url('/') }}" class="nav__link">INICIO</a>
                <a href="{{ route('catalogo.index') }}" class="nav__link">CATÁLOGO</a>
                <a href="#" class="nav__link nav__link--active">CHECKOUT</a>
            </nav>

            <a href="{{ route('profile.edit') }}" class="user-section" style="text-decoration: none; color: inherit;">
                <span class="user-section__name">{{ Auth::user()->name }}</span>
                <div class="user-section__avatar">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </a>
        </div>
    </header>

    {{-- Contenido principal --}}
    <main class="checkout" x-data="checkoutHandler({{ $precio_convertido }}, '{{ $currency }}', '{{ request('mode', 'reserva') }}', '{{ request('fechas', '') }}')" x-init="init()">
        <div class="checkout__container">

            <div class="checkout__header">
                <h1 class="checkout__title">Finalizar Operación</h1>
                <p class="checkout__subtitle">
                    Gestión para: <span class="highlight">{{ $moto->modelo }}</span>
                </p>
            </div>

            <div class="checkout__toggle">
                <button @click="setMode('reserva')" type="button" class="toggle-btn" :class="mode === 'reserva' ? 'toggle-btn--active' : ''">
                    <svg class="toggle-btn__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Comprar (Señal)
                </button>
                <button @click="setMode('alquiler')" type="button" class="toggle-btn" :class="mode === 'alquiler' ? 'toggle-btn--active' : ''">
                    <svg class="toggle-btn__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Alquiler Diario
                </button>
            </div>

            <div class="checkout__grid">
                {{-- Columna izquierda --}}
                <div class="checkout__options">
                    <div x-show="mode === 'alquiler'" x-transition class="option-card option-card--rental">
                        <div class="option-card__header">
                            <svg class="option-card__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 class="option-card__title">Configurar Alquiler</h3>
                        </div>
                        <p class="option-card__desc">Tarifa: 1% del valor por día</p>
                        <label class="input-label">Selecciona fechas:</label>
                        <input x-ref="datepicker" type="text" class="input-field" placeholder="Seleccionar días...">
                        <div class="option-card__result">
                            <span>Días totales:</span>
                            <span class="option-card__days" x-text="dias"></span>
                        </div>
                    </div>

                    <div x-show="mode === 'reserva'" x-transition class="option-card option-card--purchase">
                        <div class="option-card__header">
                            <svg class="option-card__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="option-card__title">Pago de Señal</h3>
                        </div>
                        <p class="option-card__desc">Se requiere el 25% del valor para formalizar la reserva.</p>
                        <div class="option-card__info">
                            <span>Precio total:</span>
                            <span class="option-card__price">{{ number_format($precio_convertido, 2) }} <span x-text="simbolo"></span></span>
                        </div>
                    </div>

                    <div class="currency-card">
                        <label class="input-label">Moneda de pago</label>
                        <form action="{{ route('checkout', $moto_id) }}" method="GET" id="currency-form">
                            <input type="hidden" name="mode" :value="mode">
                            <input type="hidden" name="fechas" :value="fechas">
                            <select name="currency" onchange="this.form.submit()" class="input-select">
                                <option value="EUR" {{ $currency == 'EUR' ? 'selected' : '' }}>€ Euro (EUR)</option>
                                <option value="USD" {{ $currency == 'USD' ? 'selected' : '' }}>$ Dólar (USD)</option>
                                <option value="GBP" {{ $currency == 'GBP' ? 'selected' : '' }}>£ Libra (GBP)</option>
                            </select>
                        </form>
                    </div>
                </div>

                {{-- Columna derecha --}}
                <div class="checkout__summary">
                    <div class="summary-card">
                        <div class="summary-card__label" x-text="mode === 'reserva' ? 'SEÑAL A PAGAR' : 'TOTAL ALQUILER'"></div>
                        <div class="summary-card__price">
                            <span x-text="totalPagar"></span><span x-text="simbolo"></span>
                        </div>
                        <div class="summary-card__divider"></div>
                        <div id="paypal-button-container" class="summary-card__paypal"></div>
                    </div>
                </div>
            </div>

            <div class="checkout__back">
                <a href="{{ url()->previous() }}" class="btn-back">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Volver atrás
                </a>
            </div>
        </div>
    </main>

    <footer class="footer footer--simple">
        <div class="footer__container">
            <span class="footer__copyright">© 2025 Motos DMT. Todos los derechos reservados.</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=sb&currency={{ $currency }}"></script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('checkoutHandler', (precioBase, moneda, oldMode, oldFechas) => ({
                mode: oldMode,
                precioMoto: precioBase,
                dias: 1,
                fechas: oldFechas,
                simbolo: moneda === 'EUR' ? '€' : (moneda === 'GBP' ? '£' : '$'),

                init() {
                    this.initDatepicker();
                    this.calculateDays();
                    this.initPayPal();
                },

                initDatepicker() {
                    flatpickr(this.$refs.datepicker, {
                        mode: "range",
                        minDate: "today",
                        dateFormat: "Y-m-d",
                        locale: "es",
                        defaultDate: this.fechas ? this.fechas.split(/ to | a /) : null,
                        onChange: (selectedDates, dateStr) => {
                            this.fechas = dateStr;
                            if (selectedDates.length === 2) {
                                this.calculateDays();
                            } else {
                                this.dias = 1;
                            }
                        }
                    });
                },

                calculateDays() {
                    if (this.fechas && (this.fechas.includes(' to ') || this.fechas.includes(' a '))) {
                        const separator = this.fechas.includes(' to ') ? ' to ' : ' a ';
                        const dates = this.fechas.split(separator);
                        if (dates.length === 2) {
                            const start = new Date(dates[0]);
                            const end = new Date(dates[1]);
                            if (!isNaN(start) && !isNaN(end)) {
                                const diffTime = Math.abs(end - start);
                                this.dias = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                            }
                        }
                    } else {
                        this.dias = 1;
                    }
                    if (this.mode === 'alquiler') this.initPayPal();
                },

                setMode(newMode) {
                    this.mode = newMode;
                    this.initPayPal();
                },

                get totalPagar() {
                    let total = this.mode === 'reserva' ? (this.precioMoto * 0.25) : ((this.precioMoto * 0.01) * this.dias);
                    return parseFloat(total).toFixed(2);
                },

                initPayPal() {
                    if (typeof paypal === 'undefined') return;
                    const container = document.getElementById('paypal-button-container');
                    if (!container) return;

                    container.innerHTML = '';
                    paypal.Buttons({
                        style: { layout: 'vertical', color: 'black', shape: 'rect', label: 'pay' },
                        createOrder: (data, actions) => {
                            return actions.order.create({
                                purchase_units: [{ amount: { value: this.totalPagar } }]
                            });
                        },
                        onApprove: (data, actions) => {
                            return actions.order.capture().then((details) => {
                                // Payload corregido enviando el 'mode'
                                let payload = {
                                    order_id: details.id,
                                    status: details.status,
                                    amount: details.purchase_units[0].amount.value,
                                    moto_id: "{{ $moto_id }}",
                                    mode: this.mode, // Vital para el controlador
                                    currency: "{{ $currency }}"
                                };

                                if (this.mode === 'alquiler') {
                                    const sep = this.fechas.includes(' to ') ? ' to ' : ' a ';
                                    const parts = this.fechas.split(sep);
                                    payload.start_date = parts[0];
                                    payload.end_date = parts[1];
                                }

                                // Fetch dinámico usando la ruta de Laravel
                                return fetch("{{ route('paypal.process') }}", {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'Accept': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify(payload)
                                }).then(res => {
                                    if (!res.ok) return res.json().then(err => { throw err; });
                                    window.location.href = "{{ route('catalogo.index') }}?success=1";
                                }).catch(err => {
                                    console.error('Error procesando el pago:', err);
                                    alert('Error en el servidor al registrar el pago.');
                                });
                            });
                        }
                    }).render('#paypal-button-container');
                }
            }));
        });
    </script>
</body>
</html>