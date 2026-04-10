<?php

namespace Database\Factories\Sales;

use App\Models\Sales\Customers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customers>
 */
class CustomersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => fake()->company(),
            'contact_person' => fake()->name(),
            'email' => fake()->unique()->companyEmail(),
            'phone' => fake()->phoneNumber(),
            'credit_limit' => fake()->randomFloat(2, 1000, 100000),
            'sales_rep_id' => \App\Models\UsersRoles\User::factory(),
            'billing_address' => fake()->address(),
        ];
    }
}
