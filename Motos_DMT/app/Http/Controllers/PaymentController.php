<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; // El "Entity" que creamos
use App\Mail\PaymentReceived; // El "Mailable"
use Illuminate\Support\Facades\Mail; // El servicio de correo
use Illuminate\Support\Facades\Auth; // Para el Security Context
use App\Models\Moto; // Para validar el precio de la moto

class PaymentController extends Controller
{
    /**
     * Muestra la página de checkout.
     * En Spring: @GetMapping("/checkout/{moto_id}")
     */
    public function showCheckout($moto_id)
    {
        return view('checkout', ['moto_id' => $moto_id]);
    }

    /**
     * Recibe los datos de PayPal y guarda en DB.
     * En Spring: @PostMapping("/paypal/process")
     */
    public function processPayment(Request $request)
    {
        // 1. Validar los datos (Opcional pero recomendado)
        $request->validate([
            'order_id' => 'required',
            'moto_id' => 'required',
            'amount' => 'required',
        ]);

        $moto = Moto::findOrFail($request->moto_id);

        $precioReserva = $moto->precio * 0.25;

        if ($request->amount != $precioReserva) {
            return response()->json(['error' => 'Monto insuficiente'], 400);
        }

        // 2. Crear y guardar la transacción (Active Record)
        $transaction = new Transaction();
        $transaction->user_id = Auth::id(); // Usuario logueado actualmente
        $transaction->moto_id = $request->moto_id;
        $transaction->paypal_order_id = $request->order_id;
        $transaction->status = $request->status;
        $transaction->amount = $request->amount;
        $transaction->currency = 'EUR';
        $transaction->save(); // Aquí se hace el INSERT en la DB

        dd($transaction);

        // 3. Enviar el email (JavaMailSender de Laravel)
        // Usamos el email del usuario logueado
        Mail::to(Auth::user()->email)->send(new PaymentReceived($transaction));

        return response()->json([
            'message' => 'Transacción guardada y email enviado',
            'id' => $transaction->id
        ]);
    }
}