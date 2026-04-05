<?php

namespace Database\Factories;

use App\Models\Reports\BiDashboards;
use App\Models\Reports\BiWidgets;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BiWidgets>
 */
class BiWidgetsFactory extends Factory
{
    protected $model = BiWidgets::class;

    public function definition(): array
    {
        return [
            'widget_name' => fake()->words(2, true),
            'widget_type' => fake()->randomElement(['chart', 'table', 'kpi', 'gauge']),
            'dashboard_id' => BiDashboards::query()->inRandomOrder()->value('id'),
            'data_source' => fake()->randomElement(['sales_orders', 'stock_movements', 'gls']),
            'query_config' => ['metric' => fake()->randomElement(['count', 'sum', 'avg'])],
            'visualization_type' => fake()->randomElement(['line', 'bar', 'pie', 'number']),
            'position_x' => fake()->numberBetween(0, 8),
            'position_y' => fake()->numberBetween(0, 6),
            'width' => fake()->numberBetween(3, 6),
            'height' => fake()->numberBetween(2, 4),
            'refresh_interval' => fake()->randomElement([60, 300, 900]),
            'settings' => ['color' => fake()->hexColor()],
        ];
    }
}
