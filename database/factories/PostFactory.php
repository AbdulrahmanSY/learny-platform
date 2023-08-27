<?php

namespace Database\Factories;

use App\Models\ContentLevel;
use App\Models\Language;
use App\Models\Teacher;
use App\Models\TypePost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teacher_ids = Teacher::where('teacher_status_id',1)->pluck('id');
        $teacher_id = $this->faker->randomElement($teacher_ids);
        $teacher = Teacher::all()->find($teacher_id);
        $type = $this->faker->randomElement([1,2,3]);
        return [
            'teacher_id'=>$teacher_id,
            'title'=>$this->faker->text(30),
            'description'=>$this->faker->realText(),
            'type_id'=>$type,
            'language_id'=>1,
            'content_levels_id'=>$this->faker->randomElement(ContentLevel::all()->pluck('id')),
        ];
    }
}
