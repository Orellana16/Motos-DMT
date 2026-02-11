<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $manufacturer_id
 * @property int $category_id
 * @property string $modelo
 * @property string|null $imagen
 * @property string|null $descripcion
 * @property int $año
 * @property int $cilindrada En CC
 * @property numeric $precio
 * @property int $stock
 * @property bool $disponible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Accessory> $accessories
 * @property-read int|null $accessories_count
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $favoritedBy
 * @property-read int|null $favorited_by_count
 * @property-read \App\Models\Manufacturer $manufacturer
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction> $transactions
 * @property-read int|null $transactions_count
 * @method static \Database\Factories\MotoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Moto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Moto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Moto query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Moto whereAño($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Moto whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Moto whereCilindrada($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Moto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Moto whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Moto whereDisponible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Moto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Moto whereImagen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Moto whereManufacturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Moto whereModelo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Moto wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Moto whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Moto whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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