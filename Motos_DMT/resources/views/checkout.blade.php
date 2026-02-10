<!DOCTYPE html>
<html>
<head>
    <title>Reserva de Moto</title>
    <script src="https://www.paypal.com/sdk/js?client-id=AQ5MNwmAvxllMiaKNtWJGfkxv6Jwt576eMGPH6k9Nh_8hbNoruMdeL2XpIcWJVKzTfN7XuTlxSyM3xe-&currency=EUR"></script>
</head>
<body>
    <h1>Reserva tu Moto</h1>
    <div id="moto-details">
        <p>Estás reservando la moto ID: <strong id="moto-id">{{ $moto_id }}</strong></p>
        <p>Precio de reserva: <strong>50.00 EUR</strong></p>
    </div>

    <div id="paypal-button-container"></div>

    <script>
        paypal.Buttons({
            // Configurar la transacción
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: { value: '50.00' }
                    }]
                });
            },

            // Cuando el usuario confirma el pago en la ventana de PayPal
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    
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