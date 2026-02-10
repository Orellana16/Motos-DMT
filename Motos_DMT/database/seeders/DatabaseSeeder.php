<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Manufacturer;
use App\Models\Category;
use App\Models\Moto;
use App\Models\Accessory;
use App\Models\Review;
use App\Models\Transaction;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear Usuarios
        echo "🧑 Creando usuarios...\n";
        $users = User::factory(50)->create();

        // 2. Crear Fabricantes (datos únicos)
        echo "🏭 Creando fabricantes...\n";
        $manufacturersData = [
            ['nombre' => 'Yamaha', 'pais' => 'Japón', 'año_fundacion' => 1955],
            ['nombre' => 'Honda', 'pais' => 'Japón', 'año_fundacion' => 1948],
            ['nombre' => 'Kawasaki', 'pais' => 'Japón', 'año_fundacion' => 1963],
            ['nombre' => 'Suzuki', 'pais' => 'Japón', 'año_fundacion' => 1952],
            ['nombre' => 'Ducati', 'pais' => 'Italia', 'año_fundacion' => 1926],
            ['nombre' => 'BMW', 'pais' => 'Alemania', 'año_fundacion' => 1923],
            ['nombre' => 'Harley-Davidson', 'pais' => 'Estados Unidos', 'año_fundacion' => 1903],
            ['nombre' => 'KTM', 'pais' => 'Austria', 'año_fundacion' => 1934],
        ];

        $manufacturers = collect();
        foreach ($manufacturersData as $data) {
            $manufacturers->push(Manufacturer::create([
                'nombre' => $data['nombre'],
                'pais' => $data['pais'],
                'logo' => 'logos/' . strtolower($data['nombre']) . '.png',
                'descripcion' => fake()->paragraph(3),
                'website' => 'https://www.' . strtolower($data['nombre']) . '.com',
                'año_fundacion' => $data['año_fundacion'],
            ]));
        }

        // 3. Crear Categorías (datos únicos)
        echo "📁 Creando categorías...\n";
        $categoriesData = [
            'Deportiva' => 'Motos de alta velocidad y rendimiento en circuito',
            'Cruiser' => 'Motos cómodas para viajes largos con estilo relajado',
            'Touring' => 'Diseñadas para viajes de larga distancia',
            'Naked' => 'Motos sin carenado, deportivas y urbanas',
            'Adventure' => 'Versátiles para carretera y fuera de carretera',
            'Scooter' => 'Motos urbanas de fácil manejo',
            'Off-Road' => 'Especializadas en terrenos irregulares',
            'Custom' => 'Motos personalizadas con estilo único',
        ];

        $categories = collect();
        foreach ($categoriesData as $nombre => $descripcion) {
            $categories->push(Category::create([
                'nombre' => $nombre,
                'slug' => \Illuminate\Support\Str::slug($nombre),
                'descripcion' => $descripcion,
                'icono' => 'icons/' . \Illuminate\Support\Str::slug($nombre) . '.svg',
                'activa' => true,
            ]));
        }

        // 4. Crear Motos
        echo "🏍️ Creando motos...\n";
        $motos = Moto::factory(100)->create();

        // 5. Crear Accesorios
        echo "🧢 Creando accesorios...\n";
        $accessories = Accessory::factory(50)->create();

        // 6. Crear Reseñas
        echo "⭐ Creando reseñas...\n";
        Review::factory(200)->create();

        // 7. Crear Transacciones
        echo "💳 Creando transacciones...\n";
        Transaction::factory(150)->create();

        // 8. Asignar accesorios a motos (Relación N:M)
        echo "🔗 Asignando accesorios a motos...\n";
        $motos->each(function ($moto) use ($accessories) {
            $moto->accessories()->attach(
                $accessories->random(rand(1, 5))->pluck('id')->toArray()
            );
        });

        // 9. Asignar motos favoritas a usuarios (Relación N:M)
        echo "❤️ Asignando motos favoritas...\n";
        $users->each(function ($user) use ($motos) {
            $user->favoriteMotos()->attach(
                $motos->random(rand(1, 10))->pluck('id')->toArray()
            );
        });

        echo "\n✅ ¡Base de datos poblada exitosamente!\n";
    }
}