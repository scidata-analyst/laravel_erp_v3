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
            'task_title' => $this->faker->sentence(3),
            'project_name' => $this->faker->company() . ' Project',
            'assigned_user_id' => \App\Models\UsersRoles\User::factory(),
            'priority' => $this->faker->randomElement(['Low', 'Medium', 'High', 'Critical']),
            'due_date' => $this->faker->dateTimeBetween('now', '+2 weeks'),
            'status' => $this->faker->randomElement(['To Do', 'In Progress', 'Review', 'Done']),
            'description' => $this->faker->optional()->paragraph(),
        ];
    }
}
