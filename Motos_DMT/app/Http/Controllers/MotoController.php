<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Moto;
// Importamos el Facade correcto para evitar errores de configuración
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class MotoController extends Controller
{
    public function index(Request $request)
    {
        $query = Moto::with(['manufacturer', 'category']);

        // 1. BUSCADOR
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('modelo', 'LIKE', "%{$search}%")
                    ->orWhere('descripcion', 'LIKE', "%{$search}%")
                    ->orWhereHas('manufacturer', function ($q2) use ($search) {
                        $q2->where('nombre', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('category', function ($q3) use ($search) {
                        $q3->where('nombre', 'LIKE', "%{$search}%");
                    });
            });
        }

        $sort = $request->get('sort', 'id_asc');

        switch ($sort) {
            case 'price_asc':
                $query->orderBy('precio', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('precio', 'desc');
                break;
            case 'year_desc':
                $query->orderBy('año', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('id', 'asc');
                break;
        }

        $motos = $query->paginate(9)->withQueryString();

        return view('catalogo', compact('motos'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateMoto($request);

        // Subida a Cloudinary
        $url = Cloudinary::upload($request->file('imagen')->getRealPath())->getSecurePath();

        $validated['imagen'] = $url;
        Moto::create($validated);

        return redirect()->route('catalogo.index')->with('success', '¡Bestia añadida al garaje!');
    }

    /**
     * Mostrar el formulario para editar una moto
     */
    public function edit($id)
    {
        // Buscamos la moto o lanzamos error 404 si no existe
        $moto = Moto::findOrFail($id);

        // Traemos todos los fabricantes y categorías para llenar los select
        $fabricadores = Manufacturer::all();
        $categorias = Category::all();

        return view('edit', compact('moto', 'fabricadores', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $moto = Moto::findOrFail($id);

        // Validamos
        $validated = $this->validateMoto($request, true);

        // Si el usuario sube una imagen nueva, la cambiamos. Si no, dejamos la que estaba.
        if ($request->hasFile('imagen')) {
            $url = Cloudinary::upload($request->file('imagen')->getRealPath())->getSecurePath();
            $validated['imagen'] = $url;
        }

        $moto->update($validated);

        return redirect()->route('catalogo.index')->with('success', 'Moto actualizada correctamente');
    }

    /**
     * FUNCIÓN DE APOYO: Para no repetir las reglas de validación dos veces
     */
    protected function validateMoto(Request $request, $isUpdate = false)
    {
        return $request->validate([
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'category_id' => 'required|exists:categories,id',
            'modelo' => 'required|string|max:255',
            'imagen' => ($isUpdate ? 'nullable' : 'required') . '|string',
            'descripcion' => 'nullable|string',
            'año' => 'required|integer',
            'cilindrada' => 'required|integer',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'disponible' => 'required|boolean',
        ]);
    }

    public function destroy($id)
    {
        Moto::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Moto eliminada correctamente');
    }
}