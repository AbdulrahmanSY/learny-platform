<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use function PHPUnit\Framework\isNull;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoleUser>
 */
class RoleUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [

                'role_id'=>$this->faker->randomElement(Role::query()->pluck('id'))

        ];


    }
}
