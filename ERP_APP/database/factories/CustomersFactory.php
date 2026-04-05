<?php

namespace Database\Factories;

use App\Models\Sales\Customers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customers>
 */
class CustomersFactory extends Factory
{
    protected $model = Customers::class;

    public function definition(): array
    {
        return [
            'company_name' => fake()->unique()->company(),
            'contact_person' => fake()->name(),
            'email' => fake()->companyEmail(),
            'phone' => fake()->phoneNumber(),
            'credit_limit' => fake()->randomFloat(2, 5000, 150000),
            'sales_rep' => fake()->name(),
            'billing_address' => fake()->address(),
            'shipping_address' => fake()->address(),
            'status' => fake()->randomElement(['active', 'inactive']),
            'tax_id' => fake()->optional()->bothify('TIN-#####'),
            'payment_terms' => fake()->randomElement(['Cash', 'Net 15', 'Net 30', 'Net 45']),
        ];
    }
}
