<?php

namespace Database\Factories\QualityControl;

use App\Models\QualityControl\QcChecklists;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<QcChecklists>
 */
class QcChecklistsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_batch_work_order' => fake()->bothify('WO-####'),
            'inspector_id' => \App\Models\UsersRoles\User::factory(),
            'inspection_type' => fake()->randomElement(['Pre-production', 'In-process', 'Final', 'Random']),
            'inspection_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'sample_size' => fake()->numberBetween(5, 100),
            'checklist_items_notes' => fake()->optional()->sentence(),
            'status' => fake()->randomElement(['Pending', 'Pass', 'Fail', 'Conditional']),
        ];
    }
}
