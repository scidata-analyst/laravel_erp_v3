<?php

namespace Database\Factories;

use App\Models\CRM\Leads;
use App\Models\CRM\Support;
use App\Models\Sales\Customers;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Support>
 */
class SupportFactory extends Factory
{
    protected $model = Support::class;

    public function definition(): array
    {
        $created = fake()->dateTimeBetween('-2 months', 'now');

        return [
            'ticket_number' => 'TKT-' . Str::upper(fake()->unique()->bothify('######')),
            'customer_id' => fake()->boolean(70) ? Customers::query()->inRandomOrder()->value('id') : null,
            'lead_id' => fake()->boolean(40) ? Leads::query()->inRandomOrder()->value('id') : null,
            'subject' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
            'category' => fake()->randomElement(['Billing', 'Technical', 'Account', 'Shipping']),
            'assigned_to' => User::query()->inRandomOrder()->value('id'),
            'status' => fake()->randomElement(['open', 'pending', 'resolved', 'closed']),
            'resolution' => fake()->optional()->sentence(),
            'resolution_date' => fake()->optional()->dateTimeBetween($created, 'now'),
            'customer_satisfaction' => fake()->optional()->numberBetween(1, 5),
            'response_time_hours' => fake()->randomFloat(2, 1, 72),
            'created_date' => $created,
            'last_response_date' => fake()->optional()->dateTimeBetween($created, 'now'),
            'comments' => fake()->optional()->sentence(),
        ];
    }
}
