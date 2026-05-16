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
            'ticket_number' => $this->faker->unique()->numerify('TKT-#####'),
            'customer_id' => \App\Models\Sales\Customers::factory(),
            'subject' => $this->faker->randomElement(['Login issue', 'Payment problem', 'Product defect', 'Delivery delay', 'Account access']),
            'description' => $this->faker->paragraph(),
            'priority' => $this->faker->randomElement(['Low', 'Medium', 'High', 'Critical']),
            'category' => $this->faker->randomElement(['Technical', 'Billing', 'General', 'Feature Request']),
            'assigned_user_id' => \App\Models\UsersRoles\User::factory(),
            'status' => $this->faker->randomElement(['Open', 'In Progress', 'Pending', 'Resolved', 'Closed']),
        ];
    }
}
