<?php

namespace App\Http\Controllers;

use App\Models\Moto;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index(Request $request)
    {
        $query = Moto::query()->with('manufacturer');

        // SEARCH (por modelo + fabricante)
        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('modelo', 'like', "%{$search}%")
                  ->orWhereHas('manufacturer', function ($mq) use ($search) {
                      $mq->where('nombre', 'like', "%{$search}%");
                  });
            });
        }

        // SORT
        $sort = $request->input('sort', 'id_asc');
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
            case 'id_asc':
            default:
                $query->orderBy('id', 'asc');
                break;
        }

        // PAGINATION
        $motos = $query->paginate(12)->withQueryString();

        return view('catalogo', compact('motos'));
    }
}
