<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Moto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'moto_id' => Moto::factory(),
            'rating' => fake()->numberBetween(1, 5),
            'comentario' => fake()->paragraph(3),
            'verificado' => fake()->boolean(70),
            'utilidad' => fake()->numberBetween(0, 50),
        ];
    }
}