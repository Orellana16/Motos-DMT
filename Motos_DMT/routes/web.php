<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

// Ruta para mostrar la vista con el botón de PayPal
Route::get('/checkout/{moto_id}', [PaymentController::class, 'showCheckout'])->name('checkout');

// Ruta donde PayPal enviará la confirmación (POST)
Route::post('/paypal/process', [PaymentController::class, 'processPayment']);
