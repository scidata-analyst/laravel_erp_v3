<?php

namespace Database\Factories\Projects;

use App\Models\Projects\ProjectCost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProjectCost>
 */
class ProjectCostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_name' => fake()->company() . ' Project',
            'cost_category' => fake()->randomElement(['Labor', 'Materials', 'Equipment', 'Travel', 'Other']),
            'amount' => fake()->randomFloat(2, 100, 50000),
            'date_incurred' => fake()->dateTimeBetween('-6 months', 'now'),
            'approved_by_user_id' => \App\Models\UsersRoles\User::factory(),
            'description' => fake()->optional()->sentence(),
            'status' => fake()->randomElement(['Pending', 'Approved', 'Rejected']),
        ];
    }
}
