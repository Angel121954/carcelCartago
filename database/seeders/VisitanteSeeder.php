<?php

namespace Database\Seeders;

use App\Models\Visitante;
use Illuminate\Database\Seeder;

class VisitanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Visitante::firstOrCreate([
            'numero_identificacion' => '1000000001',
        ], [
            'nombre_completo' => 'Ana Maria Perez',
            'relacion' => 'Madre',
        ]);

        Visitante::firstOrCreate([
            'numero_identificacion' => '1000000002',
        ], [
            'nombre_completo' => 'Carlos Eduardo Gomez',
            'relacion' => 'Hermano',
        ]);

        Visitante::firstOrCreate([
            'numero_identificacion' => '1000000003',
        ], [
            'nombre_completo' => 'Laura Sofia Ramirez',
            'relacion' => 'Abogado',
        ]);
    }
}
