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
            'company_name' => $this->faker->company(),
            'contact_person' => $this->faker->name(),
            'email' => $this->faker->unique()->companyEmail(),
            'phone' => $this->faker->phoneNumber(),
            'credit_limit' => $this->faker->randomFloat(2, 1000, 100000),
            'sales_rep_id' => \App\Models\UsersRoles\User::factory(),
            'billing_address' => $this->faker->address(),
        ];
    }
}
