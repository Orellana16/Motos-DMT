<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Moto;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        // Buscamos una moto al azar
        $moto = Moto::inRandomOrder()->first() ?? Moto::factory()->create();

        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'moto_id' => $moto->id,
            'paypal_order_id' => 'PAYID-' . strtoupper(fake()->bothify('??#?#?#?#?')),
            'status' => 'COMPLETED',
            'amount' => $moto->precio * 0.25,
            'currency' => 'EUR',
        ];
    }
}