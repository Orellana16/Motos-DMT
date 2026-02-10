<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Moto;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        $moto = Moto::inRandomOrder()->first() ?? Moto::factory()->create();
        $statuses = ['COMPLETED', 'PENDING', 'FAILED', 'REFUNDED'];

        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'moto_id' => $moto->id,
            'paypal_order_id' => 'ORDER-' . fake()->unique()->uuid(),
            'status' => fake()->randomElement($statuses),
            'amount' => $moto->precio,
            'currency' => fake()->randomElement(['EUR', 'USD', 'GBP']),
        ];
    }
}