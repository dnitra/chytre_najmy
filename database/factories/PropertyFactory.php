<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->realText($maxNbChars = 20),
            'property_type_id' => $this->faker->numberBetween(1, 4),
            'address_id' => $this->faker->numberBetween(1, 15),
        ];
    }
}
