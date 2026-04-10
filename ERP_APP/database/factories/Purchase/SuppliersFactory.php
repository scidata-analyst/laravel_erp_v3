<?php

namespace Database\Factories\Purchase;

use App\Models\Purchase\Suppliers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Suppliers>
 */
class SuppliersFactory extends Factory
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
            'country' => fake()->country(),
            'payment_terms' => fake()->randomElement(['Net 30', 'Net 60', 'Net 90', 'Prepayment']),
            'currency' => fake()->randomElement(['USD', 'EUR', 'GBP', 'BDT']),
            'address' => fake()->address(),
            'status' => fake()->randomElement(['Active', 'Inactive', 'Suspended']),
        ];
    }
}
