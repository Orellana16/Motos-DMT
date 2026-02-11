<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/checkout/{moto_id}', [PaymentController::class, 'showCheckout'])
    ->middleware('auth')
    ->name('checkout');

Route::post('/paypal/process', [PaymentController::class, 'processPayment'])
    ->middleware('auth');

require __DIR__.'/auth.php';

// Rutas de MotoController
use App\Http\Controllers\MotoController;

Route::get('/motos', [MotoController::class, 'index']);
Route::get('/motos/{id}', [MotoController::class, 'show']);
Route::post('/motos', [MotoController::class, 'store']);
Route::put('/motos/{id}', [MotoController::class, 'update']);
Route::delete('/motos/{id}', [MotoController::class, 'destroy']);

// Rutas de AccessoryController
use App\Http\Controllers\AccessoryController;

Route::get('/accessories', [AccessoryController::class, 'index']);
Route::get('/accessories/{id}', [AccessoryController::class, 'show']);
Route::post('/accessories', [AccessoryController::class, 'store']);
Route::put('/accessories/{id}', [AccessoryController::class, 'update']);
Route::delete('/accessories/{id}', [AccessoryController::class, 'destroy']);

// Rutas de ReviewController
use App\Http\Controllers\ReviewController;

Route::get('/reviews', [ReviewController::class, 'index']);
Route::get('/reviews/{id}', [ReviewController::class, 'show']);
Route::post('/reviews', [ReviewController::class, 'store']);
Route::put('/reviews/{id}', [ReviewController::class, 'update']);
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);
