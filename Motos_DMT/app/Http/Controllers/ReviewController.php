<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Listar todas las reviews
     */
    public function index()
    {
        $reviews = Review::with(['user', 'moto'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($reviews);
    }

    /**
     * Mostrar una review específica
     */
    public function show($id)
    {
        $review = Review::with(['user', 'moto'])
            ->findOrFail($id);

        return response()->json($review);
    }

    /**
     * Crear una nueva review
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'    => 'required|exists:users,id',
            'moto_id'    => 'required|exists:motos,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string',
            'verificado' => 'required|boolean',
            'utilidad'   => 'nullable|integer|min:0',
        ]);

        $review = Review::create($validated);

        return response()->json([
            'message' => 'Review creada correctamente',
            'data' => $review
        ], 201);
    }

    /**
     * Actualizar una review existente
     */
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $validated = $request->validate([
            'rating'     => 'sometimes|integer|min:1|max:5',
            'comentario' => 'nullable|string',
            'verificado' => 'sometimes|boolean',
            'utilidad'   => 'sometimes|integer|min:0',
        ]);

        $review->update($validated);

        return response()->json([
            'message' => 'Review actualizada correctamente',
            'data' => $review->fresh()
        ]);
    }

public function destroy($id)
{
    $review = \App\Models\Review::findOrFail($id);
    $review->delete();

    return response()->json([
        'message' => 'Review eliminada correctamente'
    ]);
}

}
