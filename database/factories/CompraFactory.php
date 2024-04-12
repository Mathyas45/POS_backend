<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compra>
 */
class CompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha' => $this->faker->date(),
            'tipo_comprobante' => $this->faker->randomElement(['boleta', 'factura']),
            'serie' => $this->faker->randomNumber(4, true),
            'correlativo' => $this->faker->randomNumber(8, true),
            'subtotal' => $this->faker->randomFloat(2, 0, 1000),
            'total' => $this->faker->randomFloat(2, 0, 1000),
            'forma_pago' => $this->faker->randomElement(['efectivo', 'tarjeta', 'transferencia']),
            'estado' => $this->faker->randomElement(['pendiente', 'cancelado']),
            'proveedor_id' => function () {
                return \App\Models\Proveedor::factory()->create()->id;
            },
            'moneda_id' => function () {
                return \App\Models\Moneda::factory()->create()->id;
            },
            'sucursal_id' => function () {
                return \App\Models\Sucursal::factory()->create()->id;
            },

        ];
    }
}
