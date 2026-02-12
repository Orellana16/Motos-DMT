<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use Illuminate\Http\Request;

class AccessoryController extends Controller
{
    /**
     * Listar todos los accesorios
     */
    public function index()
    {
        $accessories = Accessory::with('motos')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($accessories);
    }

    /**
     * Mostrar un accesorio específico
     */
    public function show($id)
    {
        $accessory = Accessory::with('motos')
            ->findOrFail($id);

        return response()->json($accessory);
    }

    /**
     * Crear un nuevo accesorio
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio'      => 'required|numeric',
            'imagen'      => 'nullable|string',
            'stock'       => 'required|integer',
            'categoria'   => 'nullable|string|max:255',
        ]);

        $accessory = Accessory::create($validated);

        return response()->json([
            'message' => 'Accesorio creado correctamente',
            'data' => $accessory
        ], 201);
    }

    /**
     * Actualizar un accesorio existente
     */
    public function update(Request $request, $id)
    {
        $accessory = Accessory::findOrFail($id);

        $validated = $request->validate([
            'nombre'      => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string',
            'precio'      => 'sometimes|numeric',
            'imagen'      => 'nullable|string',
            'stock'       => 'sometimes|integer',
            'categoria'   => 'nullable|string|max:255',
        ]);

        $accessory->update($validated);

        return response()->json([
            'message' => 'Accesorio actualizado correctamente',
            'data' => $accessory->fresh()
        ]);
    }

public function destroy($id)
{
    $accessory = Accessory::findOrFail($id);
    $accessory->delete();

    return response()->json([
        'message' => 'Accesorio eliminado correctamente'
    ]);
}

}
