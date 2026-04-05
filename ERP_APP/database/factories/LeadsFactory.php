<?php

namespace Database\Factories;

use App\Models\CRM\Leads;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Leads>
 */
class LeadsFactory extends Factory
{
    protected $model = Leads::class;

    public function definition(): array
    {
        return [
            'lead_name' => fake()->name(),
            'company' => fake()->company(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'deal_value' => fake()->randomFloat(2, 1000, 50000),
            'stage' => fake()->randomElement(['New', 'Qualified', 'Proposal', 'Negotiation']),
            'assigned_to' => User::query()->inRandomOrder()->value('id'),
            'next_action_date' => fake()->optional()->dateTimeBetween('now', '+1 month'),
            'source' => fake()->randomElement(['Website', 'Referral', 'Email', 'Phone']),
            'probability' => fake()->numberBetween(10, 90),
            'notes' => fake()->optional()->sentence(),
            'status' => fake()->randomElement(['open', 'won', 'lost', 'qualified']),
        ];
    }
}
