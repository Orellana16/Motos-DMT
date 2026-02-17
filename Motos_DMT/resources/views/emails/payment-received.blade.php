<!DOCTYPE html>
<html>
<head>
    <style>
        .button:hover { background-color: #ff0000 !important; }
    </style>
</head>
<body style="background-color: #0a0a0a; color: #ffffff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 20px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #1a1a1a; border: 2px solid #ff4444; border-radius: 10px; overflow: hidden;">
        <tr>
            <td align="center" style="padding: 40px 0; background: linear-gradient(45deg, #1a1a1a, #330000);">
                <h1 style="color: #ff4444; font-family: 'Orbitron', sans-serif; text-transform: uppercase; letter-spacing: 5px; margin: 0;">MOTOS DMT</h1>
                <p style="color: #cccccc; text-transform: uppercase; font-size: 12px; letter-spacing: 2px;">Ni un pelo de tontos</p>
            </td>
        </tr>

        <tr>
            <td style="padding: 40px;">
                <h2 style="color: #ffffff; border-bottom: 1px solid #333; padding-bottom: 10px;">¡CONFIRMACIÓN DE {{ strtoupper($tipo) }}!</h2>
                <p style="font-size: 16px; line-height: 1.6; color: #dddddd;">
                    Hola, piloto. Los motores ya están calentando. Hemos recibido correctamente el pago de tu {{ $tipo }}.
                </p>
                
                <div style="background-color: #000; padding: 20px; border-left: 4px solid #ff4444; margin: 20px 0;">
                    <p style="margin: 5px 0;"><strong>BESTIA:</strong> {{ $data['moto_modelo'] }}</p>
                    <p style="margin: 5px 0;"><strong>TOTAL PAGADO:</strong> {{ $data['amount'] }} EUR</p>
                    <p style="margin: 5px 0;"><strong>ORDEN ID:</strong> {{ $data['order_id'] }}</p>
                </div>

                <p style="font-size: 14px; color: #888888;">
                    Puedes revisar los detalles de tu adquisición entrando en tu perfil de usuario en nuestra plataforma.
                </p>

                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 30px;">
                    <tr>
                        <td align="center">
                            <a href="{{ url('/profile') }}" class="button" style="background-color: #ff4444; color: #ffffff; padding: 15px 30px; text-decoration: none; font-weight: bold; border-radius: 5px; display: inline-block; text-transform: uppercase;">VER MI CUENTA</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td align="center" style="padding: 20px; background-color: #000; font-size: 11px; color: #555555;">
                © 2026 MOTOS DMT. No respondas a este correo, es un envío automático desde el garaje.
            </td>
        </tr>
    </table>
</body>
</html>