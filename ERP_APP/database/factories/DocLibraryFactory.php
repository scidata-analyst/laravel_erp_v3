<?php

namespace Database\Factories;

use App\Models\Documents\DocLibrary;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DocLibrary>
 */
class DocLibraryFactory extends Factory
{
    protected $model = DocLibrary::class;

    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'category' => fake()->randomElement(['Policy', 'SOP', 'Invoice', 'HR', 'Quality']),
            'file_path' => 'documents/' . fake()->uuid() . '.pdf',
            'file_size' => fake()->numberBetween(10240, 5242880),
            'file_type' => fake()->randomElement(['pdf', 'docx', 'xlsx']),
            'version' => '1.' . fake()->numberBetween(0, 9),
            'uploaded_by' => User::query()->inRandomOrder()->value('id'),
            'department' => fake()->randomElement(['HR', 'Finance', 'Operations', 'Quality']),
            'status' => fake()->randomElement(['active', 'archived', 'draft']),
            'tags' => json_encode(fake()->words(3)),
            'notes' => fake()->optional()->sentence(),
            'expiry_date' => fake()->optional()->dateTimeBetween('+1 month', '+2 years'),
        ];
    }
}
