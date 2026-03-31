<?php

namespace Database\Factories;

use App\Models\Prisionero;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Prisionero>
 */
class PrisioneroFactory extends Factory
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
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '2005-01-01'),
            'fecha_ingreso' => $this->faker->date(),
            'delito' => $this->faker->sentence(6),
            'celda' => 'Celda-' . $this->faker->numberBetween(1, 100),
        ];
    }
}
