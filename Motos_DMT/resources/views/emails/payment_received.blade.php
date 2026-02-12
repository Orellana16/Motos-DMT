<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            border: 1px solid #eee;
            padding: 20px;
            border-radius: 10px;
        }

        .header {
            background: #d32f2f;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .content {
            margin: 20px 0;
        }

        .footer {
            font-size: 0.8em;
            color: #777;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Motos DMT</h1>
        </div>
        <div class="content">
            <h2>¡Reserva Confirmada!</h2>

            <p>Hola {{ $userName }},</p>
            <p>¡Gracias por tu reserva! Hemos recibido tu pago de {{ number_format($amount, 2) }} {{ $currency }} por la
                moto {{ $motoModel }}.</p>

            <p>Para completar el proceso, debes acudir a nuestras oficinas con tu DNI y carnet de conducir.</p>

            <div style="margin: 20px 0; padding: 15px; border: 1px solid #ddd;">
                <h3>📍 ¿Dónde estamos?</h3>
                <p>Haz clic en el enlace para ver la ruta en el mapa:</p>
                <a href="{{ $mapLink }}"
                    style="background: #4F46E5; color: white; padding: 10px 20px; text-decoration: none; rounded: 5px;">
                    Ver ubicación en Google Maps
                </a>
            </div>
        </div>
        <div class="footer">
            © 2026 Motos DMT - Pasión por las dos ruedas.
        </div>
    </div>
</body>

</html>