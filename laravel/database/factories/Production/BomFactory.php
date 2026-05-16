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
            'finished_product_name' => $this->faker->words(2, true) . ' Product',
            'version' => 'v' . $this->faker->numerify('#.#'),
            'lead_time_days' => $this->faker->numberBetween(1, 30),
            'status' => $this->faker->randomElement(['Draft', 'Active', 'Obsolete']),
        ];
    }
}
