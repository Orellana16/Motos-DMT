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
                <p style="color: #cccccc; text-transform: uppercase; font-size: 12px; letter-spacing: 2px;">Registro de Nuevos Pilotos</p>
            </td>
        </tr>

        <tr>
            <td style="padding: 40px;">
                <h2 style="color: #ffffff; border-bottom: 1px solid #333; padding-bottom: 10px;">¡BIENVENIDO A LA HERMANDAD!</h2>
                <p style="font-size: 16px; line-height: 1.6; color: #dddddd;">
                    Hola, <strong>{{ $nombre }}</strong>. Gracias por unirte a Motos DMT. Antes de empezar a rodar y reservar nuestras bestias, necesitamos confirmar que este es tu garaje oficial.
                </p>
                
                <p style="font-size: 16px; color: #dddddd; margin-bottom: 30px;">
                    Pulsa el botón para verificar tu dirección de correo electrónico:
                </p>

                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td align="center">
                            <a href="{{ $url }}" class="button" style="background-color: #ff4444; color: #ffffff; padding: 18px 35px; text-decoration: none; font-weight: bold; border-radius: 5px; display: inline-block; text-transform: uppercase; letter-spacing: 1px;">VERIFICAR MI CUENTA</a>
                        </td>
                    </tr>
                </table>

                <p style="font-size: 13px; color: #888888; margin-top: 30px; line-height: 1.5;">
                    Si no has creado ninguna cuenta en nuestra plataforma, puedes ignorar este mensaje sin problemas.
                </p>
            </td>
        </tr>

        <tr>
            <td align="center" style="padding: 20px; background-color: #000; font-size: 11px; color: #555555;">
                © 2026 MOTOS DMT — GAS & GLORY.
            </td>
        </tr>
    </table>
</body>
</html>