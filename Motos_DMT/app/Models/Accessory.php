<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'stock',
        'categoria'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
    ];

    // Relación N:M con Motos
    public function motos()
    {
        return $this->belongsToMany(Moto::class, 'moto_accessory')
                    ->withTimestamps();
    }
}