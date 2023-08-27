<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class   TeacherStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        		DB::table('teacher_statuses')->delete();

        		$seed = array(

        			array( 'status_name' => 'Accepted'),
        			array( 'status_name' => 'Rejected'),
        			array( 'status_name' => 'Pending'),
        		);

        		DB::table('teacher_statuses')->insert($seed);
    }
}
