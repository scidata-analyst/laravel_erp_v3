<?php

namespace Database\Factories;

use App\Models\HR\Departments;
use App\Models\User;
use App\Models\UsersRoles\Roles;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    protected static ?string $password = null;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => Roles::query()->inRandomOrder()->value('id'),
            'department_id' => Departments::query()->inRandomOrder()->value('id'),
            'status' => fake()->randomElement(['active', 'inactive']),
            'last_login_at' => fake()->optional()->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
