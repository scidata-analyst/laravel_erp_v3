<?php

namespace Database\Factories\Projects;

use App\Models\Projects\Tasks;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tasks>
 */
class TasksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task_title' => fake()->sentence(3),
            'project_name' => fake()->company() . ' Project',
            'assigned_user_id' => \App\Models\UsersRoles\User::factory(),
            'priority' => fake()->randomElement(['Low', 'Medium', 'High', 'Critical']),
            'due_date' => fake()->dateTimeBetween('now', '+2 weeks'),
            'status' => fake()->randomElement(['To Do', 'In Progress', 'Review', 'Done']),
            'description' => fake()->optional()->paragraph(),
        ];
    }
}
