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
            'lead_name' => fake()->name(),
            'company' => fake()->company(),
            'email' => fake()->unique()->email(),
            'phone' => fake()->phoneNumber(),
            'deal_value' => fake()->randomFloat(2, 1000, 100000),
            'stage' => fake()->randomElement(['New', 'Contacted', 'Qualified', 'Proposal', 'Negotiation', 'Won', 'Lost']),
            'assigned_user_id' => \App\Models\UsersRoles\User::factory(),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
