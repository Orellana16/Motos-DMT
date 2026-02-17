<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Moto;
use App\Mail\PaymentReceived;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http; // Necesario para la API de divisas

class PaymentController extends Controller
{
    /**
     * Muestra la página de checkout con conversión de divisas en tiempo real.
     * Cumple con el requisito de "Exchange Rates API" de la Fase 2[cite: 67].
     */
    public function showCheckout(Request $request, $moto_id)
    {
        $moto = Moto::findOrFail($moto_id);

        // Calculamos el 25% de reserva obligatorio
        $precio = $moto->precio * 0.25;

        // Obtenemos la divisa seleccionada por el usuario (por defecto EUR)
        $currency = $request->get('currency', 'EUR');

        // Consumo de la API externa en tiempo real
        $url = config('services.exchangerate.url') . config('services.exchangerate.key') . "/pair/EUR/{$currency}/{$precio}";

        $response = Http::get($url);

        // Si la API falla, el precio convertido será nulo para evitar errores en la vista
        $precio_convertido = $response->successful() ? $response->json()['conversion_result'] : null;

        return view('checkout', [
            'moto' => $moto,
            'precio' => $precio,
            'precio_convertido' => $precio_convertido,
            'currency' => $currency,
            'moto_id' => $moto_id
        ]);
    }

    /**
     * Recibe los datos de PayPal, registra en DB y envía email.
     * Cumple con el requisito de "Pasarela de Pagos"[cite: 60, 61, 62].
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'moto_id' => 'required',
            'mode' => 'required', // reserva o alquiler
        ]);

        $moto = Moto::findOrFail($request->moto_id);

        // 1. Guardar la transacción normalmente
        $transaction = new Transaction();
        $transaction->user_id = Auth::id();
        $transaction->moto_id = $moto->id;
        $transaction->paypal_order_id = $request->order_id;
        $transaction->status = $request->status;
        $transaction->amount = $request->amount;
        $transaction->currency = $request->get('currency', 'EUR');
        $transaction->save();

        // 2. LÓGICA DE STOCK: Solo si es compra/reserva
        if ($request->mode === 'reserva') {
            if ($moto->stock > 0) {
                $moto->decrement('stock');
            } else {
                return response()->json(['error' => 'No hay stock disponible'], 422);
            }
        }

        // 3. Envío de correo (Mailtrap)
        $data = [
            'moto_modelo' => $moto->modelo,
            'amount' => $request->amount,
            'order_id' => $request->order_id
        ];

        try {
            Mail::to(Auth::user()->email)->send(new \App\Mail\PaymentReceived($data, $request->mode));
        } catch (\Exception $e) {
            \Log::error("Error Mail: " . $e->getMessage());
        }

        return response()->json(['status' => 'success']);
    }
}