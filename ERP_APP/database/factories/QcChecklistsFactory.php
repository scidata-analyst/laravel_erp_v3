<?php

namespace Database\Factories;

use App\Models\HR\Employees;
use App\Models\Production\WorkOrders;
use App\Models\QualityControl\QcChecklists;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<QcChecklists>
 */
class QcChecklistsFactory extends Factory
{
    protected $model = QcChecklists::class;

    public function definition(): array
    {
        $itemsChecked = fake()->numberBetween(10, 100);
        $itemsPassed = fake()->numberBetween(0, $itemsChecked);

        return [
            'checklist_number' => 'QCL-' . Str::upper(fake()->unique()->bothify('######')),
            'work_order_id' => WorkOrders::query()->inRandomOrder()->value('id'),
            'inspector_id' => Employees::query()->inRandomOrder()->value('id'),
            'inspection_type' => fake()->randomElement(['in_process', 'final', 'incoming']),
            'inspection_date' => fake()->dateTimeBetween('-2 months', 'now'),
            'sample_size' => fake()->numberBetween(5, 50),
            'items_checked' => $itemsChecked,
            'items_passed' => $itemsPassed,
            'pass_rate' => round(($itemsPassed / max(1, $itemsChecked)) * 100, 2),
            'status' => fake()->randomElement(['passed', 'failed', 'pending']),
            'checklist_items' => [
                ['label' => 'Dimensions', 'status' => fake()->randomElement(['pass', 'fail'])],
                ['label' => 'Packaging', 'status' => fake()->randomElement(['pass', 'fail'])],
            ],
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
