<?php

namespace Database\Factories\HR;

use App\Models\HR\Performance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Performance>
 */
class PerformanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => \App\Models\HR\Employees::factory(),
            'review_period' => fake()->year() . ' Q' . fake()->numberBetween(1, 4),
            'kpi_score' => fake()->randomFloat(2, 50, 100),
            'goal_achievement' => fake()->randomFloat(2, 0, 100),
            'overall_rating' => fake()->randomElement(['Excellent', 'Good', 'Satisfactory', 'Needs Improvement', 'Poor']),
            'reviewer_comments' => fake()->optional()->sentence(),
            'status' => fake()->randomElement(['Draft', 'Submitted', 'Reviewed']),
        ];
    }
}
