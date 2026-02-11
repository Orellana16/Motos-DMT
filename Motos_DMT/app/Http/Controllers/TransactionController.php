<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Listar todas las transacciones
     */
    public function index()
    {
        $transactions = Transaction::with(['user', 'moto'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($transactions);
    }

    /**
     * Mostrar una transacción concreta
     */
    public function show($id)
    {
        $transaction = Transaction::with(['user', 'moto'])
            ->findOrFail($id);

        return response()->json($transaction);
    }

    /**
     * Crear una nueva transacción
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'         => 'required|exists:users,id',
            'moto_id'         => 'required|exists:motos,id',
            'paypal_order_id' => 'required|string|max:255|unique:transactions,paypal_order_id',
            'status'          => 'required|string|max:50',
            'amount'          => 'required|numeric',
            'currency'        => 'required|string|max:10',
        ]);

        $transaction = Transaction::create($validated);

        return response()->json([
            'message' => 'Transacción creada correctamente',
            'data' => $transaction
        ], 201);
    }

    /**
     * Actualizar una transacción existente
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $validated = $request->validate([
            'status'   => 'sometimes|string|max:50',
            'amount'   => 'sometimes|numeric',
            'currency' => 'sometimes|string|max:10',
        ]);

        $transaction->update($validated);

        return response()->json([
            'message' => 'Transacción actualizada correctamente',
            'data' => $transaction->fresh()
        ]);
    }

    /**
     * Eliminar una transacción
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return response()->json([
            'message' => 'Transacción eliminada correctamente'
        ]);
    }
}
