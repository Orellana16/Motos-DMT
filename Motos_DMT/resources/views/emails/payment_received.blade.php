<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { width: 80%; margin: 20px auto; border: 1px solid #eee; padding: 20px; border-radius: 10px; }
        .header { background: #d32f2f; color: white; padding: 10px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { margin: 20px 0; }
        .footer { font-size: 0.8em; color: #777; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Motos DMT</h1>
        </div>
        <div class="content">
            <h2>¡Hola! Gracias por tu reserva</h2>
            <p>Hemos recibido correctamente el pago de la señal para tu moto.</p>
            <ul>
                <li><strong>ID Transacción:</strong> {{ $transaction->paypal_order_id }}</li>
                <li><strong>Importe pagado:</strong> {{ $transaction->amount_formatted }}</li>
                <li><strong>Estado:</strong> {{ $transaction->status }}</li>
            </ul>
            <p>Nos pondremos en contacto contigo pronto para finalizar los detalles de la entrega.</p>
        </div>
        <div class="footer">
            © 2026 Motos DMT - Pasión por las dos ruedas.
        </div>
    </div>
</body>
</html>