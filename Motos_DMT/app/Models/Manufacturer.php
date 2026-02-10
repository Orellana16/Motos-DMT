<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'pais',
        'logo',
        'descripcion',
        'website',
        'año_fundacion'
    ];

    public function motos()
    {
        return $this->hasMany(Moto::class);
    }
}