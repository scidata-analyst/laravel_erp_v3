<?php

namespace Database\Factories\Reports;

use App\Models\Reports\BiDashboards;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BiDashboards>
 */
class BiDashboardsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'widget_name' => $this->faker->words(2, true),
            'chart_type' => $this->faker->randomElement(['Line', 'Bar', 'Pie', 'Area', 'Table']),
            'data_source_module' => $this->faker->randomElement(['Sales', 'Purchase', 'Inventory', 'HR', 'Finance']),
            'refresh_rate' => $this->faker->randomElement(['1 min', '5 min', '15 min', '1 hour', 'Daily']),
            'dashboard_name' => $this->faker->company() . ' Dashboard',
            'created_by_user_id' => \App\Models\UsersRoles\User::factory(),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
