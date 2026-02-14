<?php

namespace App\Http\Controllers;

use App\Models\Moto;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;

class MotoController extends Controller
{
    /**
     * Listar todas las motos
     */
    public function index(Request $request)
    {
        $query = Moto::with(['manufacturer', 'category']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('modelo', 'LIKE', "%{$search}%")
                    ->orWhere('descripcion', 'LIKE', "%{$search}%")

                    // Cambia 'name' por 'nombre' (o el nombre real de tu columna)
                    ->orWhereHas('manufacturer', function ($q2) use ($search) {
                        $q2->where('nombre', 'LIKE', "%{$search}%");
                    })

                    // Cambia 'name' por 'nombre' aquí también
                    ->orWhereHas('category', function ($q3) use ($search) {
                        $q3->where('nombre', 'LIKE', "%{$search}%");
                    });
            });
        }

        $motos = $query->orderBy('created_at', 'desc')->paginate(9)->withQueryString();

        return view('catalogo', compact('motos'));
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
            'category_id' => 'required|exists:categories,id',
            'modelo' => 'required|string|max:255',
            'imagen' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'descripcion' => 'nullable|string',
            'año' => 'required|integer',
            'cilindrada' => 'required|integer',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'disponible' => 'required|boolean',
        ]);

        // Subir a Cloudinary y obtener la URL segura
        $objImagen = Cloudinary::upload($request->file('imagen')->getRealPath());
        $url = $objImagen->getSecurePath();

        // Guardar en la DB
        $validated['imagen'] = $url;
        Moto::create($validated);

        return redirect()->route('catalogo.index');
    }

    /**
     * Actualizar una moto existente
     */
    public function update(Request $request, $id)
    {
        $moto = Moto::findOrFail($id);

        $validated = $request->validate([
            'manufacturer_id' => 'sometimes|exists:manufacturers,id',
            'category_id' => 'sometimes|exists:categories,id',
            'modelo' => 'sometimes|string|max:255',
            'imagen' => 'nullable|string',
            'descripcion' => 'nullable|string',
            'año' => 'sometimes|integer',
            'cilindrada' => 'sometimes|integer',
            'precio' => 'sometimes|numeric',
            'stock' => 'sometimes|integer',
            'disponible' => 'sometimes|boolean',
        ]);

        $moto->update($validated);

        return response()->json([
            'message' => 'Moto actualizada correctamente',
            'data' => $moto->fresh()
        ]);
    }

    public function destroy($id)
    {
        $moto = Moto::findOrFail($id);
        $moto->delete();

        // CAMBIO: Redirigir atrás con un mensaje de éxito
        return redirect()->back()->with('success', 'Moto eliminada correctamente');
    }

}
