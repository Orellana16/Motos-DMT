<?php

namespace App\Http\Controllers;

use App\Models\Moto;
use App\Models\Category;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class MotoWebController extends Controller
{
    /**
     * Vista web: catálogo (Blade)
     */
    public function catalogo()
    {
        $motos = Moto::with(['manufacturer', 'category'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('catalogo', compact('motos'));
    }

    /**
     * Vista web: detalle de moto (Blade)
     */
    public function show(Moto $moto)
    {
        $moto->load([
            'manufacturer',
            'category',
            'accessories',
            'reviews' // si Review tiene relación user, se puede: 'reviews.user'
        ]);

        return view('motos.show', compact('moto'));
    }

    /**
     * Vista web: formulario crear
     */
    public function create()
    {
        $fabricadores = Manufacturer::orderBy('nombre')->get();
        $categorias   = Category::orderBy('nombre')->get();

        return view('new', compact('fabricadores', 'categorias'));
    }

    /**
     * Acción web: guardar moto
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'category_id'     => 'required|exists:categories,id',
            'modelo'          => 'required|string|max:255',
            'imagen'          => 'nullable|image|max:4096',
            'descripcion'     => 'nullable|string',
            'año'             => 'required|integer|min:1900|max:2100',
            'cilindrada'      => 'required|integer|min:50',
            'precio'          => 'required|numeric|min:0',
            'stock'           => 'required|integer|min:0',
            'disponible'      => 'required|boolean',
        ]);

        // Guardado de imagen en storage/app/public/motos
        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('motos', 'public');
        } else {
            // si viene como string (por compatibilidad), lo dejamos pasar
            // pero en este flujo web lo normal es file upload
            unset($validated['imagen']);
        }

        Moto::create($validated);

        return redirect()->route('catalogo')->with('success', 'Moto creada correctamente');
    }

    /**
     * Vista web: formulario editar
     */
    public function edit(Moto $moto)
    {
        $fabricadores = Manufacturer::orderBy('nombre')->get();
        $categorias   = Category::orderBy('nombre')->get();

        return view('edit', compact('moto', 'fabricadores', 'categorias'));
    }

    /**
     * Acción web: actualizar
     */
    public function update(Request $request, Moto $moto)
    {
        $validated = $request->validate([
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'category_id'     => 'required|exists:categories,id',
            'modelo'          => 'required|string|max:255',
            'imagen'          => 'nullable|image|max:4096',
            'descripcion'     => 'nullable|string',
            'año'             => 'required|integer|min:1900|max:2100',
            'cilindrada'      => 'required|integer|min:50',
            'precio'          => 'required|numeric|min:0',
            'stock'           => 'required|integer|min:0',
            'disponible'      => 'required|boolean',
        ]);

        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('motos', 'public');
        } else {
            unset($validated['imagen']);
        }

        $moto->update($validated);

        return redirect()->route('catalogo')->with('success', 'Moto actualizada correctamente');
    }

    /**
     * Acción web: eliminar
     */
    public function destroy(Moto $moto)
    {
        $moto->delete();

        return redirect()->route('catalogo')->with('success', 'Moto eliminada correctamente');
    }
}
