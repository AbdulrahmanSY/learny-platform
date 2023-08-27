<?php

namespace Database\Factories;

use App\Models\Answers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answers>
 */
class AnswersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'answer'=>fake()->word(),
            'correct'=>false,
            'question_id'=>fake()->numberBetween(1,100),
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Answers $answer) {
            if ($answer->question->answer()->where('correct', true)->count() === 0) {
                $answer->correct = true;
                $answer->save();
            }
        });
    }

}
