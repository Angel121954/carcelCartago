<?php

namespace Database\Factories;

use App\Models\SesionGuardia;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Guardia;
/**
 * @extends Factory<SesionGuardia>
 */
class SesionGuardiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'guardia_id' => Guardia::inRandomOrder()->first()->id,

            'fecha_hora_inicio' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
