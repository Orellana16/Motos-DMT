<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = ['user_id', 'moto_id', 'start_date', 'end_date', 'total_price', 'status'];

    // Relación con el usuario (quién alquila)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con la moto (qué alquila)
    public function moto()
    {
        return $this->belongsTo(Moto::class);
    }
}