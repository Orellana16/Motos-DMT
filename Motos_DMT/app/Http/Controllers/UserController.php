<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Listar todos los usuarios
     */
    public function index()
    {
        $users = User::with(['transactions', 'reviews', 'favoriteMotos'])
            ->orderBy('name')
            ->get();

        return response()->json($users);
    }

    /**
     * Mostrar un usuario concreto
     */
    public function show($id)
    {
        $user = User::with(['transactions', 'reviews', 'favoriteMotos'])
            ->findOrFail($id);

        return response()->json($user);
    }
}
