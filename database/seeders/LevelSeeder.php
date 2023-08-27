<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seed = array(
            array('level_name' => 'A1'),
            array('level_name' => 'A2'),
            array('level_name' => 'B1'),
            array('level_name' => 'B2'),
            array('level_name' => 'C1'),
            array('level_name' => 'C2'),
        );
        DB::table('levels')->insert($seed);
    }
}
