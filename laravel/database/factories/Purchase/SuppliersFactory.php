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
            'company_name' => $this->faker->company(),
            'contact_person' => $this->faker->name(),
            'email' => $this->faker->unique()->companyEmail(),
            'phone' => $this->faker->phoneNumber(),
            'country' => $this->faker->country(),
            'payment_terms' => $this->faker->randomElement(['Net 30', 'Net 60', 'Net 90', 'Prepayment']),
            'currency' => $this->faker->randomElement(['USD', 'EUR', 'GBP', 'BDT']),
            'address' => $this->faker->address(),
            'status' => $this->faker->randomElement(['Active', 'Inactive', 'Suspended']),
        ];
    }
}
