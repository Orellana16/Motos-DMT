<!DOCTYPE html>
<html>
<head>
    <style>
        .card { border: 1px solid #e2e8f0; padding: 20px; border-radius: 8px; font-family: sans-serif; }
        .badge { padding: 4px 8px; border-radius: 4px; font-weight: bold; }
        .reserva { background-color: #dcfce7; color: #166534; }
        .alquiler { background-color: #dbeafe; color: #1e40af; }
    </style>
</head>
<body>
    <div class="card">
        <h1>¡Hola, {{ auth()->user()->name }}!</h1>

        @if($type === 'reserva')
            <p>Has realizado la <strong>reserva de compra</strong> para tu próxima moto.</p>
            <span class="badge reserva">Tipo: Compra</span>
            <ul>
                <li>Moto: {{ $data['moto_modelo'] }}</li>
                <li>Señal pagada: {{ $data['amount'] }}€</li>
            </ul>
            <p>Pásate por nuestra oficina para formalizar la financiación y llevarte tu moto.</p>
        @else
            <p>Tu <strong>alquiler de moto</strong> ha sido confirmado correctamente.</p>
            <span class="badge alquiler">Tipo: Alquiler</span>
            <ul>
                <li>Moto: {{ $data->moto->modelo }}</li>
                <li>Desde: {{ $data->start_date }}</li>
                <li>Hasta: {{ $data->end_date }}</li>
                <li>Total pagado: {{ number_format($data->total_price, 2) }}€</li>
            </ul>
            <p>Recuerda traer tu carnet de conducir original el día de la recogida.</p>
        @endif

        <hr>
        <h3>📍 Ubicación de la oficina</h3>
        <p>Te esperamos en: Calle del Motor, 12, Cádiz.</p>
        <a href="https://maps.google.com/?q=IES+Mar+de+Cádiz">Ver en Google Maps</a>
    </div>
</body>
</html>