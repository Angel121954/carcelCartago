<?php

namespace Database\Seeders;

use App\Models\Guardia;
use Illuminate\Database\Seeder;

class GuardiaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nombre_completo' => 'Guardia Juan Perez', 'numero_identificacion' => '9000000001', 'activo' => true],
            ['nombre_completo' => 'Guardia Maria Lopez', 'numero_identificacion' => '9000000002', 'activo' => true],
            ['nombre_completo' => 'Guardia Carlos Ruiz', 'numero_identificacion' => '9000000003', 'activo' => true],
        ];

        foreach ($data as $item) {
            Guardia::firstOrCreate(
                ['numero_identificacion' => $item['numero_identificacion']],
                [
                    'nombre_completo' => $item['nombre_completo'],
                    'activo' => $item['activo'],
                ]
            );
        }
    }
}
