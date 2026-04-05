<?php

namespace Database\Factories;

use App\Models\Core\Dashboard;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Dashboard>
 */
class DashboardFactory extends Factory
{
    protected $model = Dashboard::class;

    public function definition(): array
    {
        return [
            'widget_config' => [
                ['type' => 'kpi', 'metric' => 'sales'],
                ['type' => 'chart', 'metric' => 'inventory'],
            ],
            'layout_preferences' => ['columns' => 12, 'density' => 'comfortable'],
            'theme' => fake()->randomElement(['light', 'dark']),
            'language' => fake()->randomElement(['en', 'bn']),
            'timezone' => fake()->randomElement(['Asia/Dhaka', 'UTC']),
            'default_date_range' => fake()->randomElement(['Last 7 Days', 'Last 30 Days', 'This Month']),
            'refresh_interval' => fake()->randomElement([60, 300, 900]),
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'is_default' => fake()->boolean(30),
            'dashboard_type' => fake()->randomElement(['sales', 'financial', 'operational', 'hr']),
        ];
    }
}
