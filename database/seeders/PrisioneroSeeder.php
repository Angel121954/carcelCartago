<?php

namespace Database\Seeders;

use App\Models\Prisionero;
use Illuminate\Database\Seeder;

class PrisioneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prisionero::firstOrCreate([
            'nombre_completo' => 'Luis Alberto Gomez',
            'celda' => 'A-101',
        ], [
            'nombre_completo' => 'Luis Alberto Gomez',
            'fecha_nacimiento' => '1988-04-11',
            'fecha_ingreso' => '2024-01-15',
            'delito' => 'Hurto agravado',
            'celda' => 'A-101',
        ]);

        Prisionero::firstOrCreate([
            'nombre_completo' => 'Jorge Daniel Torres',
            'celda' => 'B-204',
        ], [
            'nombre_completo' => 'Jorge Daniel Torres',
            'fecha_nacimiento' => '1979-09-23',
            'fecha_ingreso' => '2022-07-08',
            'delito' => 'Concierto para delinquir',
            'celda' => 'B-204',
        ]);

        Prisionero::firstOrCreate([
            'nombre_completo' => 'Andres Felipe Castaño',
            'celda' => 'C-309',
        ], [
            'nombre_completo' => 'Andres Felipe Castaño',
            'fecha_nacimiento' => '1992-12-02',
            'fecha_ingreso' => '2023-05-19',
            'delito' => 'Extorsion',
            'celda' => 'C-309',
        ]);
    }
}
