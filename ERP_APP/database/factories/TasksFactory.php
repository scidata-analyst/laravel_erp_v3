<?php

namespace Database\Factories;

use App\Models\Projects\Tasks;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tasks>
 */
class TasksFactory extends Factory
{
    protected $model = Tasks::class;

    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-2 months', '+1 month');
        $end = (clone $start)->modify('+' . fake()->numberBetween(3, 21) . ' days');

        return [
            'project_name' => fake()->randomElement(['ERP Rollout', 'Warehouse Upgrade', 'POS Launch', 'CRM Migration']),
            'task_title' => fake()->sentence(3),
            'description' => fake()->sentence(),
            'assigned_to' => User::query()->inRandomOrder()->value('id'),
            'start_date' => $start,
            'end_date' => $end,
            'priority' => fake()->randomElement(['Low', 'Medium', 'High', 'Critical']),
            'status' => fake()->randomElement(['Todo', 'In Progress', 'Review', 'Done']),
            'progress_percentage' => fake()->numberBetween(0, 100),
            'estimated_hours' => fake()->randomFloat(2, 4, 80),
            'actual_hours' => fake()->randomFloat(2, 0, 80),
            'dependencies' => [],
        ];
    }
}
