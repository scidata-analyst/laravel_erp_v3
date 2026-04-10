<?php

namespace Database\Factories\Purchase;

use App\Models\Purchase\SupplierPayments;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SupplierPayments>
 */
class SupplierPaymentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'supplier_id' => \App\Models\Purchase\Suppliers::factory(),
            'payment_number' => fake()->unique()->numerify('PAY-#####'),
            'invoice_reference' => fake()->optional()->numerify('INV-#####'),
            'amount' => fake()->randomFloat(2, 100, 20000),
            'payment_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'payment_method' => fake()->randomElement(['Cash', 'Bank Transfer', 'Cheque', 'Credit']),
            'status' => fake()->randomElement(['Pending', 'Completed', 'Failed']),
        ];
    }
}
