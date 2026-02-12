<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Moto;
use App\Mail\PaymentReceived;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    /**
     * Muestra la página de checkout con conversión de divisas.
     */
    public function showCheckout(Request $request, $moto_id)
    {
        $moto = Moto::findOrFail($moto_id);

        // Por defecto calculamos la reserva (25%), pero la vista puede cambiarlo a alquiler
        $reserva = $moto->precio * 0.25;
        $currency = $request->get('currency', 'EUR');

        // Consumo de la API externa
        $url = config('services.exchangerate.url') . config('services.exchangerate.key') . "/pair/EUR/{$currency}/{$reserva}";
        $response = Http::get($url);

        $precio_convertido = $response->successful() ? $response->json()['conversion_result'] : $reserva;

        return view('checkout', [
            'moto' => $moto,
            'reserva' => $reserva,
            'precio_convertido' => $precio_convertido,
            'currency' => $currency,
            'moto_id' => $moto_id
        ]);
    }

    /**
     * Procesa el pago de PayPal para RESERVAS DE COMPRA.
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'moto_id' => 'required|exists:motos,id',
            'amount' => 'required|numeric',
            'status' => 'required',
        ]);

        $moto = Moto::findOrFail($request->moto_id);

        // Registro en la base de datos
        $transaction = new Transaction();
        $transaction->user_id = Auth::id();
        $transaction->moto_id = $moto->id;
        $transaction->paypal_order_id = $request->order_id;
        $transaction->status = $request->status;
        $transaction->amount = $request->amount;
        $transaction->currency = 'EUR'; // O la que prefieras guardar como base
        $transaction->save();

        // Preparamos los datos para el email (en formato array para el mailable)
        $data = [
            'moto_modelo' => $moto->modelo,
            'amount' => $request->amount,
            'order_id' => $request->order_id
        ];

        // Enviamos el email especificando que el tipo es 'reserva'
        Mail::to(Auth::user()->email)->send(new PaymentReceived($data, 'reserva'));

        return response()->json([
            'message' => 'Reserva de compra registrada y correo enviado',
            'id' => $transaction->id
        ]);
    }
}