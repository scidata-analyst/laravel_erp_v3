<?php

namespace Database\Factories\Accounting;

use App\Models\Accounting\Tax;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tax>
 */
class TaxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tax_name' => fake()->randomElement(['VAT', 'GST', 'Sales Tax', 'Income Tax', 'Withholding Tax']),
            'tax_type' => fake()->randomElement(['Percentage', 'Fixed']),
            'rate' => fake()->randomFloat(2, 0, 30),
            'filing_period' => fake()->randomElement(['Monthly', 'Quarterly', 'Annual']),
            'applicable_on' => fake()->randomElement(['Sales', 'Purchase', 'Both']),
            'status' => fake()->randomElement(['Active', 'Inactive']),
        ];
    }
}
