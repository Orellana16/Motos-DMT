<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    MotoController,
    CatalogoController,
    ContactController,
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
| Páginas Públicas
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('inicio'))->name('home');
Route::get('/nosotros', fn () => view('nosotros'))->name('nosotros');
Route::get('/contactar', [ContactController::class, 'show'])->name('contactar');
Route::post('/contactar', [ContactController::class, 'send'])->name('contactar.send');

// Catálogo y Detalle (Público)
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');
Route::get('/motos/detalle/{moto}', [MotoController::class, 'show'])->name('motos.show');

/*
|--------------------------------------------------------------------------
| Rutas Autenticadas (Requieren Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    // Perfil de Usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestión de Motos (ADMIN / CRUD)
    // He unificado aquí las rutas que tu compañero puso como "admin" 
    // pero usando el controlador principal MotoController
    Route::prefix('motos')->name('motos.')->group(function () {
        Route::get('/create', [MotoController::class, 'create'])->name('create');
        Route::post('/', [MotoController::class, 'store'])->name('store');
        Route::get('/{moto}/edit', [MotoController::class, 'edit'])->name('edit');
        Route::put('/{moto}', [MotoController::class, 'update'])->name('update');
        Route::delete('/{moto}', [MotoController::class, 'destroy'])->name('destroy');
    });

    // Pagos y Checkout
    Route::get('/checkout/{moto_id}', [PaymentController::class, 'showCheckout'])->name('checkout');
    Route::post('/paypal/process', [PaymentController::class, 'processPayment'])->name('paypal.process');

    // Alquileres
    Route::resource('rentals', RentalController::class)->only(['index', 'store', 'destroy']);

    // Gestión de Usuarios
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
});

/*
|--------------------------------------------------------------------------
| Recursos Compartidos (Public/Auth según necesites)
|--------------------------------------------------------------------------
*/
Route::resource('accessories', AccessoryController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('categories', CategoryController::class);
Route::resource('manufacturers', ManufacturerController::class);
Route::resource('transactions', TransactionController::class);

require __DIR__ . '/auth.php';