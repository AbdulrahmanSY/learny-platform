<?php

namespace Database\Factories;

use App\Models\AppointmentStatus;
use App\Models\Goal;
use App\Models\Language;
use App\Models\Level;
use App\Models\Teacher;
use App\Models\User;
use App\Services\TeacherService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $teacherService = app(TeacherService::class);
        $teacher_id = $this->faker->randomElement(Teacher::where('teacher_status_id',1)->pluck('id'));
        $available = $this->getAvailableDays($teacher_id, $teacherService);
        if ($available == null) {
            $date = '2024/04/04';
            $time = '15:00';
        } else {
            $date = array_keys($available)[fake()->numberBetween(1, count($available)-1)];
            $times = $available[$date];
            $time = $times[fake()->numberBetween(1, count($times)-1)];
        }
        return [
            'teacher_id' => $teacher_id,
            'date' => $date,
            'time' => $time,
            "description" => fake()->sentence(5),
            'status_id' => fake()->numberBetween(1, AppointmentStatus::count()),
            'user_id' => fake()->numberBetween(1, User::count()),
            'language_id' => fake()->numberBetween(1, Language::count()),
            'level_id' => fake()->numberBetween(1, Level::count()),
            'goal_id' => fake()->numberBetween(1, Goal::count()),
            'period_id' => 1,
        ];
    }

    public function getAvailableDays($teacherId, TeacherService $teacherService): array
    {
        // Get available days for $teacherId

        $teacher = Teacher::with('workingDays')->find($teacherId);
        return $teacherService->getAvailableDays($teacher['workingDays'], $teacher->id);
    }

}
