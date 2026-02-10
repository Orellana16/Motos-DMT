<?php

namespace Database\Factories;

use App\Models\Manufacturer;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class MotoFactory extends Factory
{
    public function definition(): array
    {
        $modelos = [
            'R1', 'R6', 'MT-07', 'MT-09', 'CBR1000RR', 'CB500F',
            'Ninja 650', 'Z900', 'GSX-R1000', 'V-Strom 650',
            'Panigale V4', 'Monster 821', 'S1000RR', 'R1250GS',
            'Street 750', 'Fat Boy', '390 Duke', '1290 Super Duke'
        ];

        return [
            'manufacturer_id' => Manufacturer::inRandomOrder()->first()->id ?? Manufacturer::factory(),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'modelo' => fake()->randomElement($modelos) . ' ' . fake()->numberBetween(2020, 2024),
            'imagen' => 'motos/' . fake()->uuid() . '.jpg',
            'descripcion' => fake()->paragraph(4),
            'año' => fake()->numberBetween(2018, 2024),
            'cilindrada' => fake()->randomElement([125, 250, 300, 500, 600, 750, 1000, 1200]),
            'precio' => fake()->randomFloat(2, 3000, 25000),
            'stock' => fake()->numberBetween(0, 20),
            'disponible' => fake()->boolean(85),
        ];
    }
}