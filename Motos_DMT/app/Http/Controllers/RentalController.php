<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Moto;
use Carbon\Carbon;
use App\Mail\PaymentReceived; // IMPORTANTE: Para el envío de correos
use Illuminate\Support\Facades\Mail; // IMPORTANTE: Fachada de Mail
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    /**
     * Listado de alquileres del usuario (Punto 4: Paginación obligatoria).
     */
    public function index()
    {
        $rentals = Auth::user()->rentals()
            ->with('moto') 
            ->latest()
            ->paginate(5);

        return view('rentals.index', compact('rentals'));
    }

    /**
     * Procesa la creación de un nuevo alquiler (Llamado desde el fetch de PayPal).
     */
    public function store(Request $request)
    {
        // Validamos los datos que vienen del fetch (JSON)
        $request->validate([
            'moto_id' => 'required|exists:motos,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'order_id' => 'required', // ID de PayPal
        ]);

        $moto = Moto::findOrFail($request->moto_id);

        // --- LÓGICA CON CARBON ---
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $days = $start->diffInDays($end) + 1;

        // --- LÓGICA DEL 1% DIARIO ---
        $dailyRate = $moto->precio * 0.01;
        $totalPrice = $dailyRate * $days;

        // Guardado mediante Eloquent
        $rental = Rental::create([
            'user_id' => Auth::id(),
            'moto_id' => $moto->id,
            'start_date' => $start,
            'end_date' => $end,
            'total_price' => $totalPrice,
            'status' => 'confirmed'
        ]);

        // --- ENVÍO DE CORREO DIFERENCIADO ---
        // Pasamos el objeto $rental y el tipo 'alquiler'
        Mail::to(Auth::user()->email)->send(new PaymentReceived($rental, 'alquiler'));

        // Como esto viene de un 'fetch' en JS, respondemos con JSON
        return response()->json([
            'message' => 'Alquiler registrado y correo enviado',
            'redirect' => route('rentals.index')
        ]);
    }

    /**
     * Permite cancelar un alquiler (Parte del CRUD individual).
     */
    public function destroy(Rental $rental)
    {
        if ($rental->user_id !== Auth::id()) {
            abort(403);
        }

        $rental->delete();

        return redirect()->route('rentals.index')
            ->with('success', 'Alquiler cancelado correctamente.');
    }
}