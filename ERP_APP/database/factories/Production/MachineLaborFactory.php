<?php

namespace Database\Factories\Production;

use App\Models\Production\MachineLabor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MachineLabor>
 */
class MachineLaborFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hoursUsed = fake()->randomFloat(2, 1, 24);
        $costPerHour = fake()->randomFloat(2, 10, 100);
        
        return [
            'work_order_id' => \App\Models\Production\WorkOrders::factory(),
            'resource_name' => fake()->randomElement(['CNC Machine', 'Assembly Line', 'Packaging Unit', 'Quality Check']),
            'resource_type' => fake()->randomElement(['Machine', 'Labor']),
            'hours_used' => $hoursUsed,
            'cost_per_hour' => $costPerHour,
            'total_cost' => $hoursUsed * $costPerHour,
        ];
    }
}
