<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use Illuminate\Http\Request;

class AccessoryController extends Controller
{
    public function index()
    {
        return response()->json(Accessory::orderBy('id', 'desc')->paginate(20));
    }

    public function create()
    {
        // Si luego quieres vista Blade, cámbialo por: return view('accessories.create');
        return response()->json(['message' => 'Not implemented (create view)'], 501);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'nullable|numeric|min:0',
        ]);

        $acc = Accessory::create($data);

        return response()->json($acc, 201);
    }

    public function show(Accessory $accessory)
    {
        return response()->json($accessory);
    }

    public function edit(Accessory $accessory)
    {
        return response()->json(['message' => 'Not implemented (edit view)'], 501);
    }

    public function update(Request $request, Accessory $accessory)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'nullable|numeric|min:0',
        ]);

        $accessory->update($data);

        return response()->json($accessory);
    }

    public function destroy(Accessory $accessory)
    {
        $accessory->delete();
        return response()->json(['message' => 'Accessory deleted']);
    }
}
