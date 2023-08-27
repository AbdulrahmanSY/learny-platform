<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seed = [
            [
                'id' => 1,
                'nationality_name' => 'Syrian',
            ],
            [
                'id' => 2,
                'nationality_name' => 'Saudi',
            ],
        ];
        DB::table('nationalities')->insert($seed);
    }
}
