<?php

namespace Database\Factories\QualityControl;

use App\Models\QualityControl\Defects;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Defects>
 */
class DefectsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => \App\Models\Inventory\ProductCatalog::factory(),
            'batch_lot_number' => $this->faker->bothify('BATCH-####'),
            'defect_type' => $this->faker->randomElement(['Manufacturing', 'Material', 'Design', 'Packaging', 'Other']),
            'severity' => $this->faker->randomElement(['Critical', 'Major', 'Minor']),
            'quantity_affected' => $this->faker->numberBetween(1, 100),
            'description_root_cause' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['Open', 'Investigating', 'Resolved', 'Closed']),
        ];
    }
}
