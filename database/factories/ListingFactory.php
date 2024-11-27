<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'tags' => 'laravel, api','backend',
            'company' => $this->faker->company(),
            'email' => $this->faker->companyEmail(),
            'company' => $this->faker->company(),
            'company' => $this->faker->company(),
            'company' => $this->faker->company(),

        ];
    }
}
