<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Moto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    /**
     * Listado de alquileres del usuario (Punto 4: Paginación obligatoria).
     */
    public function index()
    {
        // Obtenemos solo los alquileres del usuario autenticado
        // Usamos paginate(5) para cumplir con los requisitos del PDF
        $rentals = Auth::user()->rentals()
            ->with('moto') // Carga ambiciosa para evitar el problema N+1
            ->latest()
            ->paginate(5);

        return view('rentals.index', compact('rentals'));
    }

    /**
     * Procesa la creación de un nuevo alquiler.
     */
    public function store(Request $request)
    {
        $request->validate([
            'moto_id' => 'required|exists:motos,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $moto = Moto::findOrFail($request->moto_id);

        // --- LÓGICA CON CARBON ---
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        
        // Calculamos la diferencia de días (mínimo 1 día)
        $days = $start->diffInDays($end) + 1;

        // --- LÓGICA DEL 1% DIARIO ---
        $dailyRate = $moto->precio * 0.01;
        $totalPrice = $dailyRate * $days;

        // Guardado mediante Eloquent
        Rental::create([
            'user_id' => Auth::id(),
            'moto_id' => $moto->id,
            'start_date' => $start,
            'end_date' => $end,
            'total_price' => $totalPrice,
            'status' => 'confirmed'
        ]);

        return redirect()->route('rentals.index')
            ->with('success', "¡Alquiler confirmado por $days días! Total: " . number_format($totalPrice, 2) . "€");
    }

    /**
     * Permite cancelar un alquiler (Parte del CRUD individual).
     */
    public function destroy(Rental $rental)
    {
        // Seguridad: Verificar que el alquiler pertenece al usuario
        if ($rental->user_id !== Auth::id()) {
            abort(403);
        }

        $rental->delete();

        return redirect()->route('rentals.index')
            ->with('success', 'Alquiler cancelado correctamente.');
    }
}