<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    MotoController,
    PaymentController,
    ProfileController,
    AccessoryController,
    ReviewController,
    CategoryController,
    ManufacturerController,
    TransactionController,
    UserController,
    RentalController
};

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('inicio');
});

Route::get('/nosotros', function () {
    return view('nosotros');
});

// ✅ CORREGIDO: Ahora el catálogo llama al controlador correctamente
Route::get('/catalogo', [MotoController::class, 'index'])->name('catalogo.index');

/*
|--------------------------------------------------------------------------
| Rutas Autenticadas (Requieren Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Perfil de Usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestión de Motos (Admin/User acciones)
    Route::get('/motos/create', [MotoController::class, 'create'])->name('motos.create');
    Route::post('/motos', [MotoController::class, 'store'])->name('motos.store');
    Route::get('/motos/{id}/edit', [MotoController::class, 'edit'])->name('edit');
    Route::put('/motos/{id}', [MotoController::class, 'update'])->name('motos.update');
    Route::delete('/motos/{id}', [MotoController::class, 'destroy'])->name('motos.destroy');
    Route::get('/motos/{id}', [MotoController::class, 'show'])->name('motos.show');

    // Pagos y Checkout
    Route::get('/checkout/{moto_id}', [PaymentController::class, 'showCheckout'])->name('checkout');
    Route::post('/paypal/process', [PaymentController::class, 'processPayment'])->name('paypal.process');

    // Alquileres
    Route::resource('rentals', RentalController::class)->only(['index', 'store', 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Rutas de API / Gestión de Recursos (Asegúrate de que devuelvan vistas o JSON según necesites)
|--------------------------------------------------------------------------
*/

// Usuarios
Route::get('/users', [UserController::class, 'index'])->middleware('auth');
Route::get('/users/{id}', [UserController::class, 'show'])->middleware('auth');

// Otros Recursos (Categorías, Marcas, etc.)
Route::resource('accessories', AccessoryController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('categories', CategoryController::class);
Route::resource('manufacturers', ManufacturerController::class);
Route::resource('transactions', TransactionController::class);

/*
|--------------------------------------------------------------------------
| Auth Routes (Login, Registro, etc.)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';