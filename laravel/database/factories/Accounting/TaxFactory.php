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
            'tax_name' => $this->faker->randomElement(['VAT', 'GST', 'Sales Tax', 'Income Tax', 'Withholding Tax']),
            'tax_type' => $this->faker->randomElement(['Percentage', 'Fixed']),
            'rate' => $this->faker->randomFloat(2, 0, 30),
            'filing_period' => $this->faker->randomElement(['Monthly', 'Quarterly', 'Annual']),
            'applicable_on' => $this->faker->randomElement(['Sales', 'Purchase', 'Both']),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
