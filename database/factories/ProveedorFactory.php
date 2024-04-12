<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\proveedor>
 */
class ProveedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->userName(),
            'direccion' => $this->faker->sentence,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'tipo_documento' => $this->faker->randomElement(['dni', 'ruc']),
            'num_documento' => $this->faker->randomNumber(9, true),
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
        ];
    }
}
