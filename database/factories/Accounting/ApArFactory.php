<?php

namespace Database\Factories\Accounting;

use App\Models\Accounting\ApAr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ApAr>
 */
class ApArFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'party_name' => fake()->company(),
            'ap_ar_type' => fake()->randomElement(['Accounts Payable', 'Accounts Receivable']),
            'amount' => fake()->randomFloat(2, 100, 50000),
            'due_date' => fake()->dateTimeBetween('now', '+3 months'),
            'reference' => fake()->optional()->numerify('REF-#####'),
            'status' => fake()->randomElement(['Pending', 'Paid', 'Overdue', 'Cancelled']),
        ];
    }
}
