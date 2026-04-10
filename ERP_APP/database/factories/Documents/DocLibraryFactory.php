<?php

namespace Database\Factories\Documents;

use App\Models\Documents\DocLibrary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DocLibrary>
 */
class DocLibraryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'document_name' => fake()->words(3, true) . '.pdf',
            'document_type' => fake()->randomElement(['Contract', 'Invoice', 'Policy', 'Manual', 'Report', 'Certificate']),
            'related_to' => fake()->randomElement(['Sales', 'Purchase', 'HR', 'Finance', 'Operations']),
            'version' => 'v' . fake()->numerify('#.#'),
            'access_level' => fake()->randomElement(['Public', 'Internal', 'Confidential', 'Restricted']),
            'file_path' => '/documents/' . fake()->uuid() . '.pdf',
            'notes' => fake()->optional()->sentence(),
            'uploaded_by_user_id' => \App\Models\UsersRoles\User::factory(),
        ];
    }
}
