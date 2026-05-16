<?php

namespace Database\Factories\Production;

use App\Models\Production\Bom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bom>
 */
class BomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'finished_product_name' => fake()->words(2, true) . ' Product',
            'version' => 'v' . fake()->numerify('#.#'),
            'lead_time_days' => fake()->numberBetween(1, 30),
            'status' => fake()->randomElement(['Draft', 'Active', 'Obsolete']),
        ];
    }
}
