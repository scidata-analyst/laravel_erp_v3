<?php

namespace Database\Factories;

use App\Models\Core\Settings;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Settings>
 */
class SettingsFactory extends Factory
{
    protected $model = Settings::class;

    public function definition(): array
    {
        $type = fake()->randomElement(['string', 'number', 'boolean', 'json']);
        $value = match ($type) {
            'number' => fake()->numberBetween(1, 100),
            'boolean' => fake()->boolean(),
            'json' => ['enabled' => fake()->boolean(), 'limit' => fake()->numberBetween(1, 10)],
            default => fake()->word(),
        };

        return [
            'setting_key' => Str::snake(fake()->unique()->words(2, true)),
            'setting_value' => $value,
            'setting_type' => $type,
            'category' => fake()->randomElement(['General', 'Security', 'Inventory', 'Notifications']),
            'description' => fake()->optional()->sentence(),
            'is_system' => fake()->boolean(40),
            'updated_by' => User::query()->inRandomOrder()->value('id'),
            'validation_rules' => ['required'],
        ];
    }
}
