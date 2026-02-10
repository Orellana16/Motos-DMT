<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer_id',
        'category_id',
        'modelo',
        'imagen',
        'descripcion',
        'año',
        'cilindrada',
        'precio',
        'stock',
        'disponible'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'disponible' => 'boolean',
    ];

    // Relación con Manufacturer
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    // Relación con Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relación con Transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Relación con Reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Relación N:M con Accessories
    public function accessories()
    {
        return $this->belongsToMany(Accessory::class, 'moto_accessory')
                    ->withTimestamps();
    }

    // Relación N:M con Users (Favoritos)
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')
                    ->withTimestamps();
    }
}