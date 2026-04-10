<?php

namespace Database\Factories\Accounting;

use App\Models\Accounting\FinReports;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FinReports>
 */
class FinReportsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['Income Statement', 'Balance Sheet', 'Cash Flow', 'Trial Balance']),
            'period' => fake()->randomElement(['Monthly', 'Quarterly', 'Annual']),
            'start_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'end_date' => fake()->dateTimeBetween('now', '+1 year'),
            'format' => fake()->randomElement(['PDF', 'Excel', 'CSV']),
        ];
    }
}
