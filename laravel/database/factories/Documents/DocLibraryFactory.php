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
            'document_name' => $this->faker->words(3, true) . '.pdf',
            'document_type' => $this->faker->randomElement(['Contract', 'Invoice', 'Policy', 'Manual', 'Report', 'Certificate']),
            'related_to' => $this->faker->randomElement(['Sales', 'Purchase', 'HR', 'Finance', 'Operations']),
            'version' => 'v' . $this->faker->numerify('#.#'),
            'access_level' => $this->faker->randomElement(['Public', 'Internal', 'Confidential', 'Restricted']),
            'file_path' => '/documents/' . $this->faker->uuid() . '.pdf',
            'notes' => $this->faker->optional()->sentence(),
            'uploaded_by_user_id' => \App\Models\UsersRoles\User::factory(),
        ];
    }
}
