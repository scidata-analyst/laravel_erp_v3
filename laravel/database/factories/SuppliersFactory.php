<?php

namespace Database\Factories;

use App\Models\Purchase\Suppliers;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuppliersFactory extends Factory
{
    protected $model = Suppliers::class;

    public function definition(): array
    {
        return [
            'supplier_name' => fake()->company(),
            'contact_person' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'status' => 'active',
        ];
    }
}
