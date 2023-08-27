<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoalSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seed = [
            [
                'id'=>1,
                'goal_name'=>'studying',
            ],
            [
                'id'=>2,
                'goal_name'=>'working',
            ],
        ];
        DB::table('goals')->insert($seed);
    }
}
