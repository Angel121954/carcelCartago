<?php

namespace Database\Factories;

use App\Models\Visita;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Prisionero;
use App\Models\Visitante;
use App\Models\Guardia;

/**
 * @extends Factory<Visita>
 */
class VisitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'prisionero_id' => Prisionero::inRandomOrder()->first()->id,
            'visitante_id' => Visitante::inRandomOrder()->first()->id,
            'guardia_id' => Guardia::inRandomOrder()->first()->id,
            'fecha' => $this->faker->dateTimeBetween('next Sunday', '+1 month')->format('Y-m-d'),
            'hora_inicio' => '14:00:00',
            'hora_fin' => '15:00:00',
        ];
    }
}
