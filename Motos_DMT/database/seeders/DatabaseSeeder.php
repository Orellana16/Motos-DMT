<?php

namespace Database\Seeders;

use App\Models\Moto;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Moto::factory(5)->create();

        $this->call([
            TransactionSeeder::class,
        ]);
    }
}
