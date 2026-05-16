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
            'product_batch_work_order' => $this->faker->bothify('WO-####'),
            'inspector_id' => \App\Models\UsersRoles\User::factory(),
            'inspection_type' => $this->faker->randomElement(['Pre-production', 'In-process', 'Final', 'Random']),
            'inspection_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'sample_size' => $this->faker->numberBetween(5, 100),
            'checklist_items_notes' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(['Pending', 'Pass', 'Fail', 'Conditional']),
        ];
    }
}
