<?php

use Illuminate\Support\Facades\Route;

// Controllers públicos
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MotoWebController;

// Controllers autenticados
use App\Http\Controllers\MotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserController;

// Resources (si los quieres públicos o protegidos, lo definimos luego)
use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Páginas públicas (NO requieren login)
|--------------------------------------------------------------------------
*/

// Home / Inicio
Route::get('/', fn () => view('inicio'))->name('home');
Route::get('/inicio', fn () => view('inicio'))->name('inicio');

// Nosotros
Route::get('/nosotros', fn () => view('nosotros'))->name('nosotros');

// Catálogo (tu vista usa route('catalogo.index'))
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');

// Alias opcional (si en algún sitio usas route('catalogo'))
Route::get('/catalogo/index', [CatalogoController::class, 'index'])->name('catalogo');

// Detalle web (PÚBLICO)
Route::get('/motos/detalle/{moto}', [MotoWebController::class, 'show'])->name('motos.show');

// Contactar
Route::get('/contactar', [ContactController::class, 'show'])->name('contactar');
Route::post('/contactar', [ContactController::class, 'send'])->name('contactar.send');


/*
|--------------------------------------------------------------------------
| Rutas autenticadas (requieren login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    // Perfil de Usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestión de Motos (ADMIN) -> MotoWebController (Blade) o MotoController (JSON)
    // Te dejo la versión web consistente con tus vistas:
    Route::get('/motos/admin/nueva', [MotoWebController::class, 'create'])->name('motos.admin.create');
    Route::post('/motos/admin', [MotoWebController::class, 'store'])->name('motos.admin.store');
    Route::get('/motos/admin/{moto}/editar', [MotoWebController::class, 'edit'])->name('motos.admin.edit');
    Route::put('/motos/admin/{moto}', [MotoWebController::class, 'update'])->name('motos.admin.update');
    Route::delete('/motos/admin/{moto}', [MotoWebController::class, 'destroy'])->name('motos.admin.destroy');

    // Pagos y Checkout
    Route::get('/checkout/{moto_id}', [PaymentController::class, 'showCheckout'])->name('checkout');
    Route::post('/paypal/process', [PaymentController::class, 'processPayment'])->name('paypal.process');

    // Alquileres
    Route::resource('rentals', RentalController::class)->only(['index', 'store', 'destroy']);

    // Usuarios (si quieres que sea solo admin en el futuro)
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
});


/*
|--------------------------------------------------------------------------
| Recursos (AHORA mismo los dejo públicos como estaban)
| Si quieres, luego los movemos a auth también
|--------------------------------------------------------------------------
*/
Route::resource('accessories', AccessoryController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('categories', CategoryController::class);
Route::resource('manufacturers', ManufacturerController::class);
Route::resource('transactions', TransactionController::class);


/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
