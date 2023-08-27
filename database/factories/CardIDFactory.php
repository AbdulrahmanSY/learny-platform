<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CardId>
 */
class CardIDFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'national_number'=>$this->faker->randomNumber('8'),
            'front_card_image'=>'/constants/cardId_images/front-of-id-card.png',
            'back_card_image'=>'/constants/cardId_images/back-of-id-card.png',
        ];
    }
}
