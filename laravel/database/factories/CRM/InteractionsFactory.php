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
            'contact_person' => $this->faker->name(),
            'interaction_type' => $this->faker->randomElement(['Call', 'Email', 'Meeting', 'Demo', 'Follow-up']),
            'interaction_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'duration' => $this->faker->numberBetween(5, 120),
            'summary' => $this->faker->sentence(),
            'next_action' => $this->faker->optional()->randomElement(['Call back', 'Send proposal', 'Schedule meeting', 'Send quote']),
        ];
    }
}
