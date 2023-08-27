<?php

namespace Database\Factories;

use App\Models\Nationality;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use phpseclib3\Crypt\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
         */
    public $maleImages = [
        'constants/personal_image/1/1.jpg',
        'constants/personal_image/1/2.jpg',
        'constants/personal_image/1/3.jpg',
        'constants/personal_image/1/4.jpg',
        'constants/personal_image/1/5.jpg',
        'constants/personal_image/1/6.jpg',
        'constants/personal_image/1/7.jpg',
        'constants/personal_image/1/8.jpg',
        'constants/personal_image/1/9.jpg',
        'constants/personal_image/1/10.jpg',
        'constants/personal_image/1/11.jpg',
        'constants/personal_image/1/12.jpg',
        'constants/personal_image/1/13.jpg',
        'constants/personal_image/1/14.jpg',

    ];
    public $femaleImages = [
        'constants/personal_image/2/1.jpg',
        'constants/personal_image/2/2.jpg',
        'constants/personal_image/2/3.jpg',
        'constants/personal_image/2/4.jpg',
        'constants/personal_image/2/5.jpg',
        'constants/personal_image/2/6.jpg',
        'constants/personal_image/2/7.jpg',
        'constants/personal_image/2/8.jpg',
        'constants/personal_image/2/9.jpg',
        'constants/personal_image/2/10.jpg',
        'constants/personal_image/2/12.jpg',
        'constants/personal_image/2/12.jpg',
        ];
    public $gender = ['female','male'];
    public $isMale;
    public function definition(): array
    {


        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'birth_date'=>fake()->dateTimeBetween('-30 years','-20 years')->format('Y-m-d'),
            'gender'=>function(){
            $this->isMale = rand(0,1);
            return $this->gender[$this->isMale];
            },
            'phone_number'=>fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'verified'=>true,
            'nationality_id'=>$this->faker->randomElement([1,2]),
            'personal_image'=>function(){
            if ($this->isMale){
                return $this->faker->randomElement($this->maleImages);
//                return  url('storage/personal_image/1/' . fake()->numberBetween(1, 12) . '.jpg');

            }else{
//                return url('storage/personal_image/2/' . fake()->numberBetween(1, 12) . '.jpg');
                return $this->faker->randomElement($this->femaleImages);
            }
            }
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
