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
            'type' => $this->faker->randomElement(['Income Statement', 'Balance Sheet', 'Cash Flow', 'Trial Balance']),
            'period' => $this->faker->randomElement(['Monthly', 'Quarterly', 'Annual']),
            'start_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'format' => $this->faker->randomElement(['PDF', 'Excel', 'CSV']),
        ];
    }
}
