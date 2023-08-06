<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            "street_and_number" => fake()->streetAddress(),
            "city" => fake()->city(),
            "country_id" =>1,
            "zip_code" => fake()->numberBetween($min = 10000, $max = 60000)
        ];
    }
}
