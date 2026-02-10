<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ManufacturerFactory extends Factory
{
    public function definition(): array
    {
        $manufacturers = [
            ['nombre' => 'Yamaha', 'pais' => 'Japón', 'año_fundacion' => 1955],
            ['nombre' => 'Honda', 'pais' => 'Japón', 'año_fundacion' => 1948],
            ['nombre' => 'Kawasaki', 'pais' => 'Japón', 'año_fundacion' => 1963],
            ['nombre' => 'Suzuki', 'pais' => 'Japón', 'año_fundacion' => 1952],
            ['nombre' => 'Ducati', 'pais' => 'Italia', 'año_fundacion' => 1926],
            ['nombre' => 'BMW', 'pais' => 'Alemania', 'año_fundacion' => 1923],
            ['nombre' => 'Harley-Davidson', 'pais' => 'Estados Unidos', 'año_fundacion' => 1903],
            ['nombre' => 'KTM', 'pais' => 'Austria', 'año_fundacion' => 1934],
        ];

        $manufacturer = fake()->randomElement($manufacturers);

        return [
            'nombre' => $manufacturer['nombre'],
            'pais' => $manufacturer['pais'],
            'logo' => 'logos/' . strtolower($manufacturer['nombre']) . '.png',
            'descripcion' => fake()->paragraph(3),
            'website' => 'https://www.' . strtolower($manufacturer['nombre']) . '.com',
            'año_fundacion' => $manufacturer['año_fundacion'],
        ];
    }
}