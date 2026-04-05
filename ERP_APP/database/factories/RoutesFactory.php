<?php

namespace Database\Factories;

use App\Models\HR\Employees;
use App\Models\Logistics\Routes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Routes>
 */
class RoutesFactory extends Factory
{
    protected $model = Routes::class;

    public function definition(): array
    {
        $distance = fake()->randomFloat(2, 5, 500);
        $estimated = fake()->randomFloat(2, 1, 12);
        $actual = round($estimated + fake()->randomFloat(2, -0.5, 2), 2);

        return [
            'route_name' => fake()->city() . ' Route',
            'driver_id' => Employees::query()->inRandomOrder()->value('id'),
            'vehicle_number' => strtoupper(fake()->bothify('VEH-####')),
            'start_location' => fake()->city(),
            'end_location' => fake()->city(),
            'route_distance' => $distance,
            'estimated_duration' => $estimated,
            'actual_duration' => max(0.5, $actual),
            'fuel_consumed' => fake()->randomFloat(2, 5, 80),
            'delivery_count' => fake()->numberBetween(1, 20),
            'status' => fake()->randomElement(['pending', 'in_progress', 'completed']),
            'route_date' => fake()->dateTimeBetween('-2 months', '+15 days'),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
