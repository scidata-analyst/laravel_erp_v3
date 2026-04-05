<?php

namespace Database\Factories;

use App\Models\HR\Attendance;
use App\Models\HR\Employees;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attendance>
 */
class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    public function definition(): array
    {
        $date = fake()->dateTimeBetween('-30 days', 'now');
        $checkIn = (clone $date)->setTime(fake()->numberBetween(8, 10), fake()->randomElement([0, 15, 30, 45]));
        $checkOut = (clone $checkIn)->modify('+' . fake()->numberBetween(7, 10) . ' hours');

        return [
            'employee_id' => Employees::query()->inRandomOrder()->value('id'),
            'date' => $date->format('Y-m-d'),
            'check_in' => $checkIn,
            'check_out' => fake()->boolean(90) ? $checkOut : null,
            'status' => fake()->randomElement(['present', 'absent', 'late', 'early_leave']),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
