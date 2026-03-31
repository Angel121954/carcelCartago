<?php

namespace Database\Factories;

use App\Models\Guardia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Guardia>
 */
class GuardiaFactory extends Factory
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

            'activo' => $this->faker->boolean(90), // 90% activos
        ];
    }
}
