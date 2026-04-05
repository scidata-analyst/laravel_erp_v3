<?php

namespace Database\Factories;

use App\Models\Reports\Forecasting;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Forecasting>
 */
class ForecastingFactory extends Factory
{
    protected $model = Forecasting::class;

    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-3 months', 'now');
        $end = (clone $start)->modify('+3 months');
        $type = fake()->randomElement(['Sales', 'Inventory', 'Revenue', 'Expense']);

        return [
            'forecast_name' => fake()->words(3, true),
            'forecast_type' => $type,
            'period_type' => fake()->randomElement(['monthly', 'quarterly']),
            'start_date' => $start,
            'end_date' => $end,
            'base_data_source' => fake()->randomElement(['Moving Average', 'Linear Regression', 'Exponential Smoothing']),
            'growth_rate' => fake()->randomFloat(2, -10, 35),
            'seasonal_factor' => fake()->randomFloat(2, 0.5, 1.5),
            'confidence_level' => fake()->randomFloat(2, 0.55, 0.98),
            'forecast_data' => [
                ['period' => $start->format('Y-m'), 'value' => fake()->randomFloat(2, 1000, 50000)],
                ['period' => $end->format('Y-m'), 'value' => fake()->randomFloat(2, 1000, 50000)],
            ],
            'created_by' => User::query()->inRandomOrder()->value('id'),
            'status' => fake()->randomElement(['Pending', 'Completed', 'Failed', 'Active']),
        ];
    }
}
