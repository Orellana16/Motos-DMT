<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Moto;
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

    public function create()
    {
        $fabricadores = Manufacturer::all();
        $categorias = Category::all();
        return view('motos.create', compact('fabricadores', 'categorias'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateMoto($request);

        // Al ser URL, simplemente guardamos el string que viene del form
        Moto::create($validated);

        return redirect()->route('catalogo.index')->with('success', '¡Bestia añadida al garaje!');
    }

    public function edit($id)
    {
        $moto = Moto::findOrFail($id);
        $fabricadores = Manufacturer::all();
        $categorias = Category::all();

        return view('edit', compact('moto', 'fabricadores', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $moto = Moto::findOrFail($id);
        $validated = $this->validateMoto($request, true);

        // Como ahora el input es de texto (URL), simplemente actualizamos
        $moto->update($validated);

        return redirect()->route('catalogo.index')->with('success', 'Moto actualizada correctamente');
    }

    /**
     * FUNCIÓN DE APOYO: Validamos que la imagen sea un string (URL)
     */
    protected function validateMoto(Request $request, $isUpdate = false)
    {
        return $request->validate([
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'category_id' => 'required|exists:categories,id',
            'modelo' => 'required|string|max:255',
            'imagen' => 'required|string',
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

    public function show(Moto $moto)
    {
        $moto->load(['manufacturer', 'category', 'accessories', 'reviews']);
        return view('motos.show', compact('moto'));
    }
}