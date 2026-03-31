<?php

namespace Database\Seeders;

use App\Models\Guardia;
use App\Models\Prisionero;
use App\Models\Visita;
use App\Models\Visitante;
use Illuminate\Database\Seeder;

class VisitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prisioneros = Prisionero::orderBy('id')->get();
        $visitantes = Visitante::orderBy('id')->get();
        $guardias = Guardia::orderBy('id')->get();

        $visitas = [
            ['fecha' => '2026-04-05', 'hora_inicio' => '14:00:00', 'hora_fin' => '14:45:00'],
            ['fecha' => '2026-04-05', 'hora_inicio' => '15:00:00', 'hora_fin' => '15:45:00'],
            ['fecha' => '2026-04-12', 'hora_inicio' => '14:30:00', 'hora_fin' => '15:15:00'],
            ['fecha' => '2026-04-12', 'hora_inicio' => '16:00:00', 'hora_fin' => '16:45:00'],
        ];

        foreach ($visitas as $index => $data) {
            $prisionero = $prisioneros[$index % $prisioneros->count()] ?? null;
            $visitante = $visitantes[$index % $visitantes->count()] ?? null;
            $guardia = $guardias[$index % $guardias->count()] ?? null;

            if ($prisionero && $visitante && $guardia) {
                Visita::firstOrCreate([
                    'prisionero_id' => $prisionero->id,
                    'visitante_id' => $visitante->id,
                    'guardia_id' => $guardia->id,
                    'fecha' => $data['fecha'],
                    'hora_inicio' => $data['hora_inicio'],
                    'hora_fin' => $data['hora_fin'],
                ]);
            }
        }
    }
}
