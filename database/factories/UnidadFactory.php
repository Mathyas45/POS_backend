<?php

namespace Database\Factories;

use App\Models\Unidad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unidad>
 */
class UnidadFactory extends Factory
{

    protected $model = Unidad::class;
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word,
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
        ];
    }
}
