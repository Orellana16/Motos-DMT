<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccessoryFactory extends Factory
{
    public function definition(): array
    {
        $categorias = ['Casco', 'Guantes', 'Chaqueta', 'Botas', 'Pantalones', 'Gafas'];
        $categoria = fake()->randomElement($categorias);

        return [
            'nombre' => fake()->words(3, true) . ' ' . $categoria,
            'descripcion' => fake()->paragraph(),
            'precio' => fake()->randomFloat(2, 20, 500),
            'imagen' => 'accessories/' . fake()->uuid() . '.jpg',
            'stock' => fake()->numberBetween(0, 100),
            'categoria' => $categoria,
        ];
    }
}