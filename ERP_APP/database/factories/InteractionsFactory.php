<?php

namespace Database\Factories;

use App\Models\CRM\Interactions;
use App\Models\CRM\Leads;
use App\Models\CRM\Support;
use App\Models\Sales\Customers;
use App\Models\Sales\SalesOrders;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Interactions>
 */
class InteractionsFactory extends Factory
{
    protected $model = Interactions::class;

    public function definition(): array
    {
        $type = fake()->randomElement(['lead', 'customer', 'sales_order', 'support']);
        $leadId = null;
        $customerId = null;
        $salesOrderId = null;
        $supportId = null;

        if ($type === 'lead') {
            $leadId = Leads::query()->inRandomOrder()->value('id');
        } elseif ($type === 'customer') {
            $customerId = Customers::query()->inRandomOrder()->value('id');
        } elseif ($type === 'sales_order') {
            $salesOrderId = SalesOrders::query()->inRandomOrder()->value('id');
        } else {
            $supportId = Support::query()->inRandomOrder()->value('id');
        }

        return [
            'interaction_type' => fake()->randomElement(['email', 'phone', 'meeting', 'note']),
            'lead_id' => $leadId,
            'customer_id' => $customerId,
            'sales_order_id' => $salesOrderId,
            'support_ticket_id' => $supportId,
            'interaction_date' => fake()->dateTimeBetween('-2 months', 'now'),
            'subject' => fake()->sentence(3),
            'description' => fake()->sentence(),
            'next_action' => fake()->optional()->sentence(3),
            'next_action_date' => fake()->optional()->dateTimeBetween('now', '+1 month'),
            'assigned_to' => User::query()->inRandomOrder()->value('id'),
            'status' => fake()->randomElement(['pending', 'completed']),
            'created_by' => User::query()->inRandomOrder()->value('id'),
        ];
    }
}
