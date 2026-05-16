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
            'payment_number' => $this->faker->unique()->numerify('PAY-#####'),
            'invoice_reference' => $this->faker->optional()->numerify('INV-#####'),
            'amount' => $this->faker->randomFloat(2, 100, 20000),
            'payment_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'payment_method' => $this->faker->randomElement(['Cash', 'Bank Transfer', 'Cheque', 'Credit']),
            'status' => $this->faker->randomElement(['Pending', 'Completed', 'Failed']),
        ];
    }
}
