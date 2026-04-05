<?php

namespace Database\Factories;

use App\Models\Reports\BiDashboards;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BiDashboards>
 */
class BiDashboardsFactory extends Factory
{
    protected $model = BiDashboards::class;

    public function definition(): array
    {
        return [
            'dashboard_name' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'widgets' => [],
            'layout_config' => ['columns' => 12],
            'data_sources' => [fake()->randomElement(['sales', 'inventory', 'finance'])],
            'refresh_interval' => fake()->randomElement([60, 300, 900]),
            'access_level' => fake()->randomElement(['executive', 'manager', 'employee']),
            'created_by' => User::query()->inRandomOrder()->value('id'),
            'is_public' => fake()->boolean(30),
            'category' => fake()->randomElement(['sales', 'financial', 'operational', 'hr']),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
