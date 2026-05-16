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
            'supplier_name' => $this->faker->company(),
            'contact_person' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'status' => 'active',
        ];
    }
}
