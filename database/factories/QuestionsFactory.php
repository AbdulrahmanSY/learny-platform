<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Questions>
 */
class QuestionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $languageId = fake()->randomElement([1, 2]); // Randomly select language ID 1 or 2

        $question = $languageId === 1 ? fake()->sentence(5) . '?' : fake()->sentence(5, true) . '?';
        $explanation = $languageId === 1 ? fake()->sentence(10) : fake()->sentence(10, true);
        return [
            'question' => $question,
            'explanation' => $explanation,
            'category_id' => fake()->numberBetween(1, 4),
            'teacher_id' => $this->faker->randomElement(Teacher::where('teacher_status_id',1)->pluck('id')),
            'content_levels_id' => $languageId,
        ];
    }

}
