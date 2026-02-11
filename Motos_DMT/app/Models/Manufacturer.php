<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nombre
 * @property string|null $pais
 * @property string|null $logo
 * @property string|null $descripcion
 * @property string|null $website
 * @property int|null $año_fundacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Moto> $motos
 * @property-read int|null $motos_count
 * @method static \Database\Factories\ManufacturerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Manufacturer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Manufacturer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Manufacturer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Manufacturer whereAñoFundacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Manufacturer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Manufacturer whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Manufacturer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Manufacturer whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Manufacturer whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Manufacturer wherePais($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Manufacturer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Manufacturer whereWebsite($value)
 * @mixin \Eloquent
 */
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