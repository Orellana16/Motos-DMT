<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Finalizar Operación') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8" x-data="checkoutHandler(
                     {{ $moto->precio }}, 
                     '{{ $currency }}', 
                     '{{ request('mode', 'reserva') }}', 
                     '{{ request('fechas', '') }}'
                 )" x-init="init()">

                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">Hola, {{ Auth::user()->name }}.</h2>
                    <p class="text-gray-600">Gestión para: <span
                            class="font-bold text-indigo-600">{{ $moto->modelo }}</span></p>
                </div>

                <div class="flex justify-center mb-10">
                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button @click="setMode('reserva')" type="button"
                            :class="mode === 'reserva' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700'"
                            class="px-6 py-2 text-sm font-medium border border-gray-200 rounded-l-lg hover:bg-gray-100 transition">
                            🛒 Comprar (Dar Señal)
                        </button>
                        <button @click="setMode('alquiler')" type="button"
                            :class="mode === 'alquiler' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700'"
                            class="px-6 py-2 text-sm font-medium border border-gray-200 rounded-r-lg hover:bg-gray-100 transition">
                            📅 Alquiler Diario
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div class="space-y-6">

                        <div x-show="mode === 'alquiler'" x-transition
                            class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                            <h3 class="text-lg font-bold text-blue-800 mb-4">Configurar Alquiler (1% día)</h3>
                            <label class="block text-sm font-medium text-gray-700">Selecciona fechas:</label>
                            <input x-ref="datepicker" type="text"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-white"
                                placeholder="Seleccionar días...">

                            <p class="mt-3 text-sm text-blue-600 font-semibold">
                                Días totales: <span x-text="dias" class="font-bold text-lg"></span>
                            </p>
                        </div>

                        <div x-show="mode === 'reserva'" x-transition
                            class="bg-green-50 p-6 rounded-lg border border-green-200">
                            <h3 class="text-lg font-bold text-green-800 mb-2">Pago de Señal</h3>
                            <p class="text-sm text-green-700">Se requiere el 25% del valor de la moto para formalizar la
                                reserva.</p>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <h3 class="text-xs font-bold mb-2 text-gray-500 uppercase italic">Moneda de pago</h3>
                            <form action="{{ route('checkout', $moto_id) }}" method="GET" id="currency-form">
                                <input type="hidden" name="mode" :value="mode">
                                <input type="hidden" name="fechas" :value="fechas">

                                <select name="currency" onchange="this.form.submit()"
                                    class="block w-full text-sm border-gray-300 rounded-md shadow-sm">
                                    <option value="EUR" {{ $currency == 'EUR' ? 'selected' : '' }}>Euro (EUR)</option>
                                    <option value="USD" {{ $currency == 'USD' ? 'selected' : '' }}>Dólar (USD)</option>
                                    <option value="GBP" {{ $currency == 'GBP' ? 'selected' : '' }}>Libra (GBP)</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <div
                        class="flex flex-col justify-center items-center bg-gray-50 rounded-xl p-8 border-2 border-dashed border-gray-300">
                        <div class="text-center mb-8">
                            <p class="text-sm text-gray-500 uppercase font-bold"
                                x-text="mode === 'reserva' ? 'Señal a pagar' : 'Precio Total Alquiler'"></p>
                            <p class="text-5xl font-black text-indigo-600">
                                <span x-text="totalPagar"></span><span x-text="simbolo"></span>
                            </p>
                        </div>

                        <div id="paypal-button-container" class="w-full"></div>
                        <p id="paypal-error" class="hidden text-red-500 text-sm mt-2">Error al cargar PayPal.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    {{-- Usamos client-id=sb para mayor estabilidad en pruebas locales --}}
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
                        defaultDate: this.fechas ? this.fechas.split(' to ') : null,
                        onChange: (selectedDates, dateStr) => {
                            if (selectedDates.length === 2) {
                                this.fechas = dateStr;
                                this.calculateDays();
                            }
                        }
                    });
                },

                calculateDays() {
                    if (this.fechas && this.fechas.includes(' to ')) {
                        const dates = this.fechas.split(' to ');
                        const start = new Date(dates[0]);
                        const end = new Date(dates[1]);
                        const diffTime = Math.abs(end - start);
                        this.dias = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                    } else {
                        this.dias = 1;
                    }
                },

                setMode(newMode) {
                    this.mode = newMode;
                },

                get totalPagar() {
                    let total = 0;
                    if (this.mode === 'reserva') {
                        total = this.precioMoto * 0.25;
                    } else {
                        total = (this.precioMoto * 0.01) * this.dias;
                    }
                    return total.toFixed(2);
                },

                initPayPal() {
                    if (typeof paypal === 'undefined') {
                        document.getElementById('paypal-error').classList.remove('hidden');
                        return;
                    }

                    // Limpiamos el div antes de renderizar para que no se acumulen botones
                    document.getElementById('paypal-button-container').innerHTML = '';

                    paypal.Buttons({
                        style: { layout: 'vertical', color: 'gold', shape: 'rect' },
                        createOrder: (data, actions) => {
                            return actions.order.create({
                                purchase_units: [{
                                    amount: { value: this.totalPagar }
                                }]
                            });
                        },
                        onApprove: (data, actions) => {
                            return actions.order.capture().then((details) => {
                                const targetUrl = this.mode === 'alquiler' ? '/rentals' : '/paypal/process';

                                let payload = {
                                    order_id: details.id,
                                    status: details.status,
                                    amount: details.purchase_units[0].amount.value,
                                    moto_id: "{{ $moto_id }}",
                                };

                                if (this.mode === 'alquiler') {
                                    const dateParts = this.fechas.split(' to ');
                                    payload.start_date = dateParts[0];
                                    payload.end_date = dateParts[1];
                                }

                                return fetch(targetUrl, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify(payload)
                                }).then(res => {
                                    window.location.href = "{{ route('dashboard') }}?success=1";
                                });
                            });
                        }
                    }).render('#paypal-button-container');
                }
            }));
        });
    </script>
</x-app-layout>