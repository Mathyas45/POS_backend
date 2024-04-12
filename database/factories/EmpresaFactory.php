<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
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
            'ruc' => $this->faker->randomNumber(9, true),

        ];
    }
}
