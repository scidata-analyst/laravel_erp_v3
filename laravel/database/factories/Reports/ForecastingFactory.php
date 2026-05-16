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
            'forecast_name' => $this->faker->words(2, true) . ' Forecast',
            'forecast_type' => $this->faker->randomElement(['Sales', 'Demand', 'Revenue', 'Inventory']),
            'period_from' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'period_to' => $this->faker->dateTimeBetween('now', '+6 months'),
            'model' => $this->faker->randomElement(['Linear Regression', 'Moving Average', 'Exponential Smoothing']),
            'accuracy_percentage' => $this->faker->randomFloat(2, 60, 99),
            'status' => $this->faker->randomElement(['Draft', 'Active', 'Archived']),
        ];
    }
}
