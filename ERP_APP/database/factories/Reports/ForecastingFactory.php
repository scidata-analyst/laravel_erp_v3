<?php

namespace Database\Factories\Reports;

use App\Models\Reports\Forecasting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Forecasting>
 */
class ForecastingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'forecast_name' => fake()->words(2, true) . ' Forecast',
            'forecast_type' => fake()->randomElement(['Sales', 'Demand', 'Revenue', 'Inventory']),
            'period_from' => fake()->dateTimeBetween('-3 months', 'now'),
            'period_to' => fake()->dateTimeBetween('now', '+6 months'),
            'model' => fake()->randomElement(['Linear Regression', 'Moving Average', 'Exponential Smoothing']),
            'accuracy_percentage' => fake()->randomFloat(2, 60, 99),
            'status' => fake()->randomElement(['Draft', 'Active', 'Archived']),
        ];
    }
}
