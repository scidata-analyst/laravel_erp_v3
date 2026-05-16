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
            'route_name' => $this->faker->bothify('Route-###'),
            'zone_area' => $this->faker->randomElement(['North', 'South', 'East', 'West', 'Central']),
            'driver_name' => $this->faker->name(),
            'vehicle_id' => $this->faker->optional()->numerify('VH-#####'),
            'number_of_stops' => $this->faker->numberBetween(1, 20),
            'route_description' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(['Active', 'Inactive', 'Under Maintenance']),
        ];
    }
}
