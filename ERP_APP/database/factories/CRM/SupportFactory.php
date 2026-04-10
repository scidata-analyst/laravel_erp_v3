<?php

namespace Database\Factories\CRM;

use App\Models\CRM\Support;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Support>
 */
class SupportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_number' => fake()->unique()->numerify('TKT-#####'),
            'customer_id' => \App\Models\Sales\Customers::factory(),
            'subject' => fake()->randomElement(['Login issue', 'Payment problem', 'Product defect', 'Delivery delay', 'Account access']),
            'description' => fake()->paragraph(),
            'priority' => fake()->randomElement(['Low', 'Medium', 'High', 'Critical']),
            'category' => fake()->randomElement(['Technical', 'Billing', 'General', 'Feature Request']),
            'assigned_user_id' => \App\Models\UsersRoles\User::factory(),
            'status' => fake()->randomElement(['Open', 'In Progress', 'Pending', 'Resolved', 'Closed']),
        ];
    }
}
