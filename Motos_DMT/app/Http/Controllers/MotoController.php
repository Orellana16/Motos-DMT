<?php

namespace App\Http\Controllers;

use App\Models\Moto;
use Illuminate\Http\Request;

class MotoController extends Controller
{
    /**
     * Listar todas las motos
     */
    public function index()
    {
        $motos = Moto::with(['manufacturer', 'category'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($motos);
    }

    /**
     * Mostrar detalle de una moto específica
     */
    public function show($id)
    {
        $moto = Moto::with([
                'manufacturer',
                'category',
                'reviews',
                'accessories'
            ])->findOrFail($id);

        return response()->json($moto);
    }

    /**
     * Crear una nueva moto
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'category_id'     => 'required|exists:categories,id',
            'modelo'          => 'required|string|max:255',
            'imagen'          => 'nullable|string',
            'descripcion'     => 'nullable|string',
            'año'             => 'required|integer',
            'cilindrada'      => 'required|integer',
            'precio'          => 'required|numeric',
            'stock'           => 'required|integer',
            'disponible'      => 'required|boolean',
        ]);

        $moto = Moto::create($validated);

        return response()->json([
            'message' => 'Moto creada correctamente',
            'data' => $moto
        ], 201);
    }

    /**
     * Actualizar una moto existente
     */
    public function update(Request $request, $id)
    {
        $moto = Moto::findOrFail($id);

        $validated = $request->validate([
            'manufacturer_id' => 'sometimes|exists:manufacturers,id',
            'category_id'     => 'sometimes|exists:categories,id',
            'modelo'          => 'sometimes|string|max:255',
            'imagen'          => 'nullable|string',
            'descripcion'     => 'nullable|string',
            'año'             => 'sometimes|integer',
            'cilindrada'      => 'sometimes|integer',
            'precio'          => 'sometimes|numeric',
            'stock'           => 'sometimes|integer',
            'disponible'      => 'sometimes|boolean',
        ]);

        $moto->update($validated);

        return response()->json([
            'message' => 'Moto actualizada correctamente',
            'data' => $moto->fresh()
        ]);
    }

public function destroy($id)
{
    $moto = \App\Models\Moto::findOrFail($id);
    $moto->delete();

    return response()->json([
        'message' => 'Moto eliminada correctamente'
    ]);
}

}
