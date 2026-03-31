<?php

namespace Database\Factories;

use App\Models\Visitante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Visitante>
 */
class VisitanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_completo' => $this->faker->name(),
            'numero_identificacion' => $this->faker->unique()->numerify('##########'),

            'relacion' => $this->faker->randomElement([
                'Padre',
                'Madre',
                'Hermano',
                'Hermana',
                'Amigo',
                'Abogado'
            ]),
        ];
    }
}
