<?php

namespace Database\Factories\CRM;

use App\Models\CRM\Leads;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Leads>
 */
class LeadsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lead_name' => $this->faker->name(),
            'company' => $this->faker->company(),
            'email' => $this->faker->unique()->email(),
            'phone' => $this->faker->phoneNumber(),
            'deal_value' => $this->faker->randomFloat(2, 1000, 100000),
            'stage' => $this->faker->randomElement(['New', 'Contacted', 'Qualified', 'Proposal', 'Negotiation', 'Won', 'Lost']),
            'assigned_user_id' => \App\Models\UsersRoles\User::factory(),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
