<?php

namespace Database\Factories\HR;

use App\Models\HR\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => \App\Models\HR\Employees::factory(),
            'attendance_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'check_in_time' => fake()->time('H:i:s'),
            'check_out_time' => fake()->optional()->time('H:i:s'),
            'status' => fake()->randomElement(['Present', 'Absent', 'Late', 'On Leave']),
            'leave_type' => fake()->optional()->randomElement(['Sick', 'Casual', 'Annual', 'Unpaid']),
        ];
    }
}
