<?php

namespace Database\Factories\CRM;

use App\Models\CRM\Interactions;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Interactions>
 */
class InteractionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => \App\Models\Sales\Customers::factory(),
            'contact_person' => fake()->name(),
            'interaction_type' => fake()->randomElement(['Call', 'Email', 'Meeting', 'Demo', 'Follow-up']),
            'interaction_date' => fake()->dateTimeBetween('-6 months', 'now'),
            'duration' => fake()->numberBetween(5, 120),
            'summary' => fake()->sentence(),
            'next_action' => fake()->optional()->randomElement(['Call back', 'Send proposal', 'Schedule meeting', 'Send quote']),
        ];
    }
}
