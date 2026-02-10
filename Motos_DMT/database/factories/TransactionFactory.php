<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::query()->inRandomOrder()->first()->id ?? \App\Models\User::factory(),
            'moto_id' => \App\Models\Moto::query()->inRandomOrder()->first()->id ?? \App\Models\Moto::factory(),
            'paypal_order_id' => 'PAYID-' . strtoupper(fake()->bothify('??#?#?#?#?')), // Simula un ID de PayPal
            'status' => fake()->randomElement(['COMPLETED', 'PENDING', 'CANCELLED']),
            'amount' => fake()->randomFloat(2, 50, 500), // Señal de reserva entre 50 y 500€
            'currency' => 'EUR',
            'created_at' => fake()->dateTimeBetween('-12 month', 'now'), // Pagos en el último mes
        ];
    }
}
