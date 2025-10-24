<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehiculo>
 */
class VehiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'marca'=> $this->faker->words(1,true),
            'modelo'=> $this->faker->words(1,true),
            'anio'=> $this->faker->numberBetween(2000, 2025),
            'color'=> $this->faker->hexColor(),
        ];
    }
}
