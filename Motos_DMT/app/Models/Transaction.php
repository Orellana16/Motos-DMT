<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}