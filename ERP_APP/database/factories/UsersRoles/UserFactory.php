<?php

namespace Database\Factories\UsersRoles;

use App\Models\UsersRoles\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'role_id' => \App\Models\UsersRoles\Roles::factory(),
            'is_active' => fake()->randomElement([true, false]),
        ];
    }
}
