<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seed = [
            [
                'id'=>1,
                'type_name'=>'Academic education'
            ],
            [
                'id'=>2,
                'type_name'=>'Vocational education'
            ],
        ];
        DB::table('doner_types')->insert($seed);
    }
}
