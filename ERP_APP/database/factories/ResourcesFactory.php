<?php

namespace Database\Factories;

use App\Models\Projects\Resources;
use App\Models\Projects\Tasks;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Resources>
 */
class ResourcesFactory extends Factory
{
    protected $model = Resources::class;

    public function definition(): array
    {
        $allocation = fake()->numberBetween(10, 100);
        $hours = fake()->randomFloat(2, 20, 150);
        $rate = fake()->randomFloat(2, 15, 150);

        return [
            'project_id' => Tasks::query()->inRandomOrder()->value('id'),
            'resource_name' => fake()->name(),
            'resource_type' => fake()->randomElement(['Employee', 'Contractor', 'Equipment']),
            'allocation_percentage' => $allocation,
            'start_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'end_date' => fake()->dateTimeBetween('now', '+3 months'),
            'cost_per_hour' => $rate,
            'total_cost' => round($hours * $rate, 2),
            'utilization_rate' => fake()->randomFloat(2, 20, 100),
            'status' => fake()->randomElement(['Active', 'Inactive', 'Completed']),
        ];
    }
}
