<?php

namespace Database\Factories;

use App\Models\Sales\Customers;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomersFactory extends Factory
{
    protected $model = Customers::class;

    public function definition(): array
    {
        return [
            'company_name' => fake()->company(),
            'contact_person' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'credit_limit' => fake()->numberBetween(5000, 100000),
            'sales_rep_id' => null,
            'billing_address' => fake()->address(),
        ];
    }
}
