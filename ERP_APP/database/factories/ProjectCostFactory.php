<?php

namespace Database\Factories;

use App\Models\Projects\ProjectCost;
use App\Models\Projects\Tasks;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProjectCost>
 */
class ProjectCostFactory extends Factory
{
    protected $model = ProjectCost::class;

    public function definition(): array
    {
        $budget = fake()->randomFloat(2, 1000, 30000);
        $actual = fake()->randomFloat(2, 500, 35000);

        return [
            'project_id' => Tasks::query()->inRandomOrder()->value('id'),
            'cost_category' => fake()->randomElement(['Labor', 'Material', 'Overhead', 'Software License']),
            'description' => fake()->sentence(),
            'budgeted_amount' => $budget,
            'actual_amount' => $actual,
            'variance' => round($actual - $budget, 2),
            'currency' => 'USD',
            'cost_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'approved_by' => fake()->boolean(60) ? User::query()->inRandomOrder()->value('id') : null,
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
