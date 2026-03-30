<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prisionero;

class PrisioneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prisionero::factory(10)->create(); // está línea crea 10 prisioneros usando la fábrica de Prisionero
    }
}
