<?php

namespace Database\Factories;

use App\Models\Accounting\Tax;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Tax>
 */
class TaxFactory extends Factory
{
    protected $model = Tax::class;

    public function definition(): array
    {
        $type = fake()->randomElement(Tax::getTaxTypes());

        return [
            'tax_name' => $type . ' ' . fake()->numberBetween(1, 20),
            'tax_rate' => fake()->randomFloat(2, 2, 18),
            'tax_type' => $type,
            'applicable_to' => fake()->randomElement(Tax::getApplicableToOptions()),
            'description' => fake()->sentence(),
            'effective_date' => fake()->dateTimeBetween('-2 years', 'now'),
            'status' => fake()->randomElement(['active', 'inactive']),
            'tax_code' => 'TAX-' . Str::upper(fake()->bothify('??##')),
            'jurisdiction' => fake()->state(),
        ];
    }
}
