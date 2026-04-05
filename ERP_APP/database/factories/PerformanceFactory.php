<?php

namespace Database\Factories;

use App\Models\HR\Employees;
use App\Models\HR\Performance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Performance>
 */
class PerformanceFactory extends Factory
{
    protected $model = Performance::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employees::query()->inRandomOrder()->value('id'),
            'review_period' => fake()->randomElement(['Q1 2026', 'Q2 2026', '2025 Annual']),
            'kpi_score' => fake()->randomFloat(2, 60, 100),
            'goal_achievement' => fake()->randomFloat(2, 55, 100),
            'overall_rating' => fake()->randomElement(['Excellent', 'Good', 'Average', 'Poor']),
            'reviewer_id' => Employees::query()->inRandomOrder()->value('id'),
            'reviewer_comments' => fake()->sentence(10),
            'review_date' => fake()->dateTimeBetween('-4 months', 'now'),
            'status' => fake()->randomElement(['pending', 'completed', 'in_review']),
            'improvement_plan' => [
                fake()->sentence(4),
                fake()->sentence(5),
            ],
        ];
    }
}
