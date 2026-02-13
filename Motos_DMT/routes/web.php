<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('catalogo');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/checkout/{moto_id}', [PaymentController::class, 'showCheckout'])
    ->middleware('auth', 'verified')
    ->name('checkout');

Route::post('/paypal/process', [PaymentController::class, 'processPayment'])
    ->middleware('auth');

require __DIR__ . '/auth.php';

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

// Rutas de CategoryController
use App\Http\Controllers\CategoryController;

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

// Rutas de ManufacturerController
use App\Http\Controllers\ManufacturerController;

Route::get('/manufacturers', [ManufacturerController::class, 'index']);
Route::get('/manufacturers/{id}', [ManufacturerController::class, 'show']);
Route::post('/manufacturers', [ManufacturerController::class, 'store']);
Route::put('/manufacturers/{id}', [ManufacturerController::class, 'update']);
Route::delete('/manufacturers/{id}', [ManufacturerController::class, 'destroy']);

// Rutas de TransactionController
use App\Http\Controllers\TransactionController;

Route::get('/transactions', [TransactionController::class, 'index']);
Route::get('/transactions/{id}', [TransactionController::class, 'show']);
Route::post('/transactions', [TransactionController::class, 'store']);
Route::put('/transactions/{id}', [TransactionController::class, 'update']);
Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);

// Rutas de UserController
use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);


// Rutas de RentalController
use App\Http\Controllers\RentalController;
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('rentals', RentalController::class)->only(['index', 'store', 'destroy']);
    Route::post('/rentals', [RentalController::class, 'store'])->name('rentals.store');
    Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
    Route::delete('/rentals/{id}', [RentalController::class, 'destroy'])->name('rentals.destroy');
});
