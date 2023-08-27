<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seed = [

            [
                'id' => 1,
                'name' => 'owner',
            ],
            [
                'id' => 2,
                'name' => 'admin',
            ],
            [
                'id' => 3,
                'name' => 'student',
            ],
            [
                'id' => 4,
                'name' => 'teacher',
            ]
        ];
        DB::table('roles')->insert($seed);
    }
}
