<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $categories = [
            'Deportiva',
            'Cruiser',
            'Touring',
            'Naked',
            'Adventure',
            'Scooter',
            'Off-Road',
            'Custom'
        ];

        $nombre = fake()->unique()->randomElement($categories);

        return [
            'nombre' => $nombre,
            'slug' => Str::slug($nombre),
            'descripcion' => fake()->paragraph(2),
            'icono' => 'icons/' . Str::slug($nombre) . '.svg',
            'activa' => fake()->boolean(90),
        ];
    }
}