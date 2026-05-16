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
            'company_name' => $this->faker->company(),
            'contact_person' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'credit_limit' => $this->faker->numberBetween(5000, 100000),
            'sales_rep_id' => null,
            'billing_address' => $this->faker->address(),
        ];
    }
}
