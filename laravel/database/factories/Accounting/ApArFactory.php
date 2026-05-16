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
            'party_name' => $this->faker->company(),
            'ap_ar_type' => $this->faker->randomElement(['Accounts Payable', 'Accounts Receivable']),
            'amount' => $this->faker->randomFloat(2, 100, 50000),
            'due_date' => $this->faker->dateTimeBetween('now', '+3 months'),
            'reference' => $this->faker->optional()->numerify('REF-#####'),
            'status' => $this->faker->randomElement(['Pending', 'Paid', 'Overdue', 'Cancelled']),
        ];
    }
}
