<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seed = [
            [
                'id'=>1,
                'language_name'=>'English'
            ],
            [
                'id'=>2,
                'language_name'=>'Arabic'
            ],
        ];
        DB::table('languages')->insert($seed);
    }
}
