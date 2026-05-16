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
            'project_name' => $this->faker->company() . ' Project',
            'cost_category' => $this->faker->randomElement(['Labor', 'Materials', 'Equipment', 'Travel', 'Other']),
            'amount' => $this->faker->randomFloat(2, 100, 50000),
            'date_incurred' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'approved_by_user_id' => \App\Models\UsersRoles\User::factory(),
            'description' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(['Pending', 'Approved', 'Rejected']),
        ];
    }
}
