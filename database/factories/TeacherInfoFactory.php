<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeacherInfo>
 */
class TeacherInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'about'=>fake()->realText(),
            'teaching_description'=>fake()->realText(),
            'video'=>'/constants/demo/demo.mp4',
        ];
    }
}
