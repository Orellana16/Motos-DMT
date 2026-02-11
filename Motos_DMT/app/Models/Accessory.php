<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property numeric $precio
 * @property string|null $imagen
 * @property int $stock
 * @property string|null $categoria
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Moto> $motos
 * @property-read int|null $motos_count
 * @method static \Database\Factories\AccessoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Accessory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Accessory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Accessory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Accessory whereCategoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Accessory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Accessory whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Accessory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Accessory whereImagen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Accessory whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Accessory wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Accessory whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Accessory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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