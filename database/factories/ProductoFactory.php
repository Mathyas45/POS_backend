<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'codigo' => $this->faker->unique()->randomNumber(5),
            'descripcion' => $this->faker->sentence,
            'precio' => $this->faker->randomFloat(2, 1, 1000),
            'stock' => $this->faker->numberBetween(0, 100),
            'stock_minimo' => $this->faker->numberBetween(0, 50),
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),

            'categoria_id' => function () {
                return \App\Models\Categoria::factory()->create()->id;
            },
            'marca_id' => function () {
                return \App\Models\Marca::factory()->create()->id;
            },
            'unidad_id' => function () {
                return \App\Models\Unidad::factory()->create()->id;
            }

        ];
    }
}
