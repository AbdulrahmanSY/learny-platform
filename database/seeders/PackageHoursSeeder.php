<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageHoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['number_of_hours'=>3,'discount'=>0.1],
            ['number_of_hours'=>5,'discount'=>0.2],
            ['number_of_hours'=>7,'discount'=>0.3],
            ['number_of_hours'=>10,'discount'=>0.4],
        ];
        DB::table('package_hours')->insert($values);
    }
}
