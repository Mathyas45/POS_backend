<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sucursal>
 */
class SucursalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word,
            'direccion' => $this->faker->sentence,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
            'responsable' => $this->faker->userName(),
            'empresa_id' => function () {
                return \App\Models\Empresa::factory()->create()->id;
            },
        ];
    }
}
