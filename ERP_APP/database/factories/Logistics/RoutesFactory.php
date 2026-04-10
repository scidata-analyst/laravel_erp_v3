<?php

namespace Database\Factories\Logistics;

use App\Models\Logistics\Routes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Routes>
 */
class RoutesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'route_name' => fake()->bothify('Route-###'),
            'zone_area' => fake()->randomElement(['North', 'South', 'East', 'West', 'Central']),
            'driver_name' => fake()->name(),
            'vehicle_id' => fake()->optional()->numerify('VH-#####'),
            'number_of_stops' => fake()->numberBetween(1, 20),
            'route_description' => fake()->optional()->sentence(),
            'status' => fake()->randomElement(['Active', 'Inactive', 'Under Maintenance']),
        ];
    }
}
