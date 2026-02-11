<div style="text-align: center; margin-top: 50px;">
    <h2>Hola, {{ Auth::user()->name }}. Estás a punto de reservar tu moto.</h2>
    <h2>Reserva de: {{ $moto->modelo }}</h2>
    <p>Precio total: <strong>{{ number_format($moto->precio, 2) }}€</strong></p>
    <p>Señal de reserva (25%): <strong style="color: green;">{{ number_format($reserva, 2) }}€</strong></p>

    <div id="paypal-button-container"></div>
</div>

<script>
    paypal.Buttons({
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        // Usamos la variable $reserva que viene de Laravel
                        value: "{{ number_format($reserva, 2, '.', '') }}"
                    }
                }]
            });
        },
        // Cuando el usuario confirma el pago en la ventana de PayPal
        onApprove: function (data, actions) {
            return actions.order.capture().then(function (details) {

                // 3. Enviamos los datos a nuestro controlador Laravel (La parte del Request)
                return fetch('/paypal/process', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        // TOKEN DE SEGURIDAD (Obligatorio en Laravel)
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
                        alert('¡Pago guardado en la DB, ' + details.payer.name.given_name + '!');
                        window.location.href = "/mis-compras"; // Redirigir al éxito
                    }
                });
            });
        }
    }).render('#paypal-button-container');
</script>
</body>

</html>