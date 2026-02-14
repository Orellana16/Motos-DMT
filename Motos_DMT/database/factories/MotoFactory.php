<?php

namespace Database\Factories;

use App\Models\Manufacturer;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class MotoFactory extends Factory
{
    public function definition(): array
    {
        // Mapeo de modelos específicos a fotos reales de alta calidad
        $fotosReales = [
            'Street 750' => 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?q=80&w=800',
            'Fat Boy' => 'https://images.unsplash.com/photo-1609630875171-b13013d763bc?q=80&w=800',
            'R1' => 'https://images.unsplash.com/photo-1614165933388-9b552b870e7b?q=80&w=800',
            'Ninja 650' => 'https://images.unsplash.com/photo-1536750053702-869799489569?q=80&w=800',
            'S1000RR' => 'https://images.unsplash.com/photo-1591637333184-19aa84b3e01f?q=80&w=800',
            'Panigale V4' => 'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?q=80&w=800',
            'MT-07' => 'https://images.unsplash.com/photo-1449491073997-75ad38744b2c?q=80&w=800',
            'GSX-R1000' => 'https://images.unsplash.com/photo-1599819811279-d5ad9cccf838?q=80&w=800',
        ];

        $modelos = [
            'R1',
            'R6',
            'MT-07',
            'MT-09',
            'CBR1000RR',
            'CB500F',
            'Ninja 650',
            'Z900',
            'GSX-R1000',
            'V-Strom 650',
            'Panigale V4',
            'Monster 821',
            'S1000RR',
            'R1250GS',
            'Street 750',
            'Fat Boy',
            '390 Duke',
            '1290 Super Duke'
        ];

        $modeloElegido = fake()->randomElement($modelos);

        // Si el modelo está en nuestra lista de fotos, la usamos. 
        // Si no, generamos una aleatoria de motos usando LoremFlickr (más estable)
        $imagenUrl = $fotosReales[$modeloElegido] ?? 'https://loremflickr.com/800/600/motorcycle,bike/all?random=' . fake()->numberBetween(1, 100);

        return [
            'manufacturer_id' => Manufacturer::inRandomOrder()->first()->id ?? Manufacturer::factory(),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'modelo' => $modeloElegido . ' ' . fake()->numberBetween(2020, 2026),
            'imagen' => $imagenUrl, // URL real directa
            'descripcion' => fake()->paragraph(4),
            'año' => fake()->numberBetween(2018, 2026),
            'cilindrada' => fake()->randomElement([125, 250, 300, 500, 600, 750, 1000, 1200]),
            'precio' => fake()->randomFloat(2, 3000, 25000),
            'stock' => fake()->numberBetween(0, 20),
            'disponible' => fake()->boolean(85),
        ];
    }
}