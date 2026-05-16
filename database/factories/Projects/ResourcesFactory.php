<?php

namespace Database\Factories\Projects;

use App\Models\Projects\Resources;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Resources>
 */
class ResourcesFactory extends Factory
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
            'project_name' => fake()->company() . ' Project',
            'allocation_percentage' => fake()->numberBetween(10, 100),
            'from_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'to_date' => fake()->dateTimeBetween('now', '+6 months'),
            'role_on_project' => fake()->randomElement(['Developer', 'Designer', 'Manager', 'Analyst', 'Tester']),
        ];
    }
}
