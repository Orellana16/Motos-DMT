<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Listar todas las categorías
     */
    public function index()
    {
        $categories = Category::with('motos')
            ->orderBy('nombre')
            ->get();

        return response()->json($categories);
    }

    /**
     * Mostrar una categoría concreta
     */
    public function show($id)
    {
        $category = Category::with('motos')
            ->findOrFail($id);

        return response()->json($category);
    }

    /**
     * Crear una nueva categoría
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:categories,slug',
            'descripcion' => 'nullable|string',
            'icono'       => 'nullable|string',
            'activa'      => 'required|boolean',
        ]);

        $category = Category::create($validated);

        return response()->json([
            'message' => 'Categoría creada correctamente',
            'data' => $category
        ], 201);
    }

    /**
     * Actualizar una categoría existente
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'nombre'      => 'sometimes|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'descripcion' => 'nullable|string',
            'icono'       => 'nullable|string',
            'activa'      => 'sometimes|boolean',
        ]);

        $category->update($validated);

        return response()->json([
            'message' => 'Categoría actualizada correctamente',
            'data' => $category->fresh()
        ]);
    }

    /**
     * Eliminar una categoría
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'message' => 'Categoría eliminada correctamente'
        ]);
    }
}
