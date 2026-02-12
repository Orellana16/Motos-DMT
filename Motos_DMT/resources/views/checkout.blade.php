<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Finalizar Reserva') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">Hola, {{ Auth::user()->name }}.</h2>
                    <p class="text-gray-600 text-lg">Estás reservando la moto: <span class="font-bold text-indigo-600">{{ $moto->modelo }}</span></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h3 class="text-xl font-bold mb-4 text-gray-700">Conversor de Divisa</h3>
                        
                        <form action="{{ route('checkout', $moto_id) }}" method="GET" id="currency-form" class="mb-4">
                            <label for="currency" class="block text-sm font-medium text-gray-700">Ver precio en:</label>
                            <select name="currency" id="currency" onchange="this.form.submit()" 
                                    class="mt-1 block w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                                <option value="EUR" {{ $currency == 'EUR' ? 'selected' : '' }}>Euro (EUR)</option>
                                <option value="USD" {{ $currency == 'USD' ? 'selected' : '' }}>Dólar Estadounidense (USD)</option>
                                <option value="GBP" {{ $currency == 'GBP' ? 'selected' : '' }}>Libra Esterlina (GBP)</option>
                                <option value="JPY" {{ $currency == 'JPY' ? 'selected' : '' }}>Yen Japonés (JPY)</option>
                                <option value="MXN" {{ $currency == 'MXN' ? 'selected' : '' }}>Peso Mexicano (MXN)</option>
                            </select>
                        </form>

                        @if($precio_convertido)
                            <div class="p-4 bg-indigo-100 rounded-md border border-indigo-200">
                                <p class="text-indigo-800 font-bold text-center text-xl">
                                    {{ number_format($precio_convertido, 2) }} {{ $currency }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col justify-center">
                        <div class="mb-6 text-center">
                            <p class="text-sm text-gray-500 uppercase tracking-widest">Señal de reserva (25%)</p>
                            {{-- IMPORTANTE: Usamos $precio_convertido porque así lo envías desde tu controlador --}}
                            <p class="text-4xl font-extrabold text-green-600">{{ number_format($precio_convertido, 2) }} {{ $currency }}</p>
                        </div>

                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 1. CARGAMOS EL SDK PRIMERO --}}
    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=EUR"></script>

    {{-- 2. LUEGO EJECUTAMOS LA LÓGICA --}}
    <script>
        // Verificamos que paypal se haya cargado antes de renderizar
        if (typeof paypal !== 'undefined') {
            paypal.Buttons({
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                // Asegúrate de que este valor coincida con la variable del controlador
                                value: "{{ number_format($precio_convertido, 2, '.', '') }}"
                            }
                        }]
                    });
                },
                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (details) {
                        return fetch('/paypal/process', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                order_id: details.id,
                                status: details.status,
                                amount: details.purchase_units[0].amount.value,
                                moto_id: "{{ $moto_id }}"
                            })
                        }).then(response => {
                            if (response.ok) {
                                window.location.href = "/dashboard?status=success";
                            }
                        });
                    });
                }
            }).render('#paypal-button-container');
        } else {
            console.error("No se pudo cargar el SDK de PayPal.");
        }
    </script>
</x-app-layout>