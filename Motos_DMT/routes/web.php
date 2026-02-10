<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

// Ruta para mostrar la vista con el botón de PayPal
Route::get('/checkout/{moto_id}', [PaymentController::class, 'showCheckout'])->name('checkout');

// Ruta donde PayPal enviará la confirmación (POST)
Route::post('/paypal/process', [PaymentController::class, 'processPayment']);

use App\Mail\PaymentReceived;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;

Route::get('/test-mail', function () {
    $transaction = Transaction::first(); // Coge la primera transacción de tu DB
    
    try {
        Mail::to('tu-email-de-prueba@example.com')->send(new PaymentReceived($transaction));
        return "¡Correo enviado! Revisa Mailtrap.";
    } catch (\Exception $e) {
        return "Error al enviar: " . $e->getMessage();
    }
});