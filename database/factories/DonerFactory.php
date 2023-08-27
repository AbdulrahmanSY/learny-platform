<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\DonerType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doner>
 */
class DonerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $doners =['Damascus university','Aleppo university','Hadarah academic','Osous academic','Baraa academic'];
    public function definition(): array
    {
        return [
            'doner_name'=>$this->faker->randomElement($this->doners),
            'doner_type_id'=>$this->faker->randomElement(DonerType::query()->pluck('id')),
            'country_id'=>$this->faker->randomElement(Country::query()->pluck('id'))
        ];
    }
}
