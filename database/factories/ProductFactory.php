<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
            'price' => $this->faker->numberBetween(100, 100500),
            'slug' => $this->faker->unique()->slug,
        ];
    }
}
