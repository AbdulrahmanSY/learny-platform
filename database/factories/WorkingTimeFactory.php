<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Type\Time;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkingTime>
 */
class WorkingTimeFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $morningShift = ['08:30','17:30'];
         $nightShift = ['15:00','22:00'];
         $bool = rand(0, 1);
        return [
            'first'=>$bool?$morningShift[0]:$nightShift[0],
            'end'=>$bool?$morningShift[1]:$nightShift[1]
        ];
    }
}
    
