<?php

namespace Database\Factories;

use App\Models\Purchase\Suppliers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Suppliers>
 */
class SuppliersFactory extends Factory
{
    protected $model = Suppliers::class;

    public function definition(): array
    {
        return [
            'company_name' => fake()->unique()->company(),
            'contact_person' => fake()->name(),
            'email' => fake()->companyEmail(),
            'phone' => fake()->phoneNumber(),
            'country' => fake()->country(),
            'payment_terms' => fake()->randomElement(['Advance', 'Net 15', 'Net 30']),
            'currency' => fake()->randomElement(['USD', 'BDT', 'EUR']),
            'address' => fake()->address(),
            'status' => fake()->randomElement(['active', 'inactive']),
            'rating' => fake()->numberBetween(2, 5),
            'tax_id' => fake()->optional()->bothify('VAT-#####'),
            'website' => fake()->url(),
        ];
    }
}
