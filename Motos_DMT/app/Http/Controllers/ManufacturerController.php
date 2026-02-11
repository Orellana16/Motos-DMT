<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    /**
     * Listar todos los fabricantes
     */
    public function index()
    {
        $manufacturers = Manufacturer::with('motos')
            ->orderBy('nombre')
            ->get();

        return response()->json($manufacturers);
    }

    /**
     * Mostrar un fabricante concreto
     */
    public function show($id)
    {
        $manufacturer = Manufacturer::with('motos')
            ->findOrFail($id);

        return response()->json($manufacturer);
    }

    /**
     * Crear un nuevo fabricante
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'         => 'required|string|max:255',
            'pais'           => 'nullable|string|max:255',
            'logo'           => 'nullable|string',
            'descripcion'    => 'nullable|string',
            'website'        => 'nullable|url',
            'año_fundacion'  => 'nullable|integer',
        ]);

        $manufacturer = Manufacturer::create($validated);

        return response()->json([
            'message' => 'Fabricante creado correctamente',
            'data' => $manufacturer
        ], 201);
    }

    /**
     * Actualizar un fabricante existente
     */
    public function update(Request $request, $id)
    {
        $manufacturer = Manufacturer::findOrFail($id);

        $validated = $request->validate([
            'nombre'         => 'sometimes|string|max:255',
            'pais'           => 'nullable|string|max:255',
            'logo'           => 'nullable|string',
            'descripcion'    => 'nullable|string',
            'website'        => 'nullable|url',
            'año_fundacion'  => 'nullable|integer',
        ]);

        $manufacturer->update($validated);

        return response()->json([
            'message' => 'Fabricante actualizado correctamente',
            'data' => $manufacturer->fresh()
        ]);
    }

    /**
     * Eliminar un fabricante
     */
    public function destroy($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        $manufacturer->delete();

        return response()->json([
            'message' => 'Fabricante eliminado correctamente'
        ]);
    }
}
