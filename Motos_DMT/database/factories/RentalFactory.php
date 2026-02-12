<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $moto = \App\Models\Moto::inRandomOrder()->first() ?? \App\Models\Moto::factory()->create();
        $startDate = now()->addDays(rand(1, 10));
        $endDate = (clone $startDate)->addDays(rand(1, 7));

        // Lógica del 1% diario
        $dias = $startDate->diffInDays($endDate) + 1;
        $totalPrice = ($moto->precio * 0.01) * $dias;

        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id ?? \App\Models\User::factory()->create()->id,
            'moto_id' => $moto->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_price' => $totalPrice,
            'status' => 'confirmed',
        ];
    }
}
