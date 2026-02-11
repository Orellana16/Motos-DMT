<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $moto_id
 * @property string $paypal_order_id
 * @property string $status
 * @property numeric $amount
 * @property string $currency
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Moto $moto
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\TransactionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereMotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction wherePaypalOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereUserId($value)
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    use HasFactory; // Esto permite usar las "Factories" que creamos para los datos de prueba

    // 1. Asignación masiva (Seguridad)
    protected $fillable = [
        'user_id', 
        'moto_id', 
        'paypal_order_id', 
        'status', 
        'amount', 
        'currency'
    ];

    // 2. Relación: Una transacción pertenece a un Usuario (Many-to-One)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 3. Relación: Una transacción pertenece a una Moto (Many-to-One)
    public function moto()
    {
        return $this->belongsTo(Moto::class);
    }

    protected function amountFormatted(): Attribute
{
    return Attribute::make(
        get: fn () => number_format($this->amount, 2, ',', '.') . ' €',
    );
}
}