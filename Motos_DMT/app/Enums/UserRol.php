<?php

namespace App\Enums;

enum UserRol: string
{
    case ADMIN = 'admin';
    case CLIENTE = 'cliente';

    // Opcional: Un método para mostrar el nombre bonito en la web
    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrador',
            self::CLIENTE => 'Piloto / Cliente',
        };
    }
}