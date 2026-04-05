<?php

namespace Database\Factories;

use App\Models\HR\Employees;
use App\Models\Production\MachineLabor;
use App\Models\Production\Machines;
use App\Models\Production\WorkOrders;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MachineLabor>
 */
class MachineLaborFactory extends Factory
{
    protected $model = MachineLabor::class;

    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-20 days', 'now');
        $end = (clone $start)->modify('+' . fake()->numberBetween(2, 12) . ' hours');

        return [
            'work_order_id' => WorkOrders::query()->inRandomOrder()->value('id'),
            'machine_id' => Machines::query()->inRandomOrder()->value('id'),
            'operator_id' => Employees::query()->inRandomOrder()->value('id'),
            'start_time' => $start,
            'end_time' => $end,
            'output_quantity' => fake()->numberBetween(0, 150),
            'scrap_quantity' => fake()->numberBetween(0, 15),
            'status' => fake()->randomElement(['pending', 'running', 'completed']),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
