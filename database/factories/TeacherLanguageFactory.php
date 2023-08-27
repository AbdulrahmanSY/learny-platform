<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeacherLanguage>
 */
class TeacherLanguageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'years_of_experience'=>rand(2,15),
            'language_id'=>$this->faker->unique()->randomElement(Language::query()->pluck('id')),
            'language_level_id'=>rand(4, 6)
        ];
    }
}
