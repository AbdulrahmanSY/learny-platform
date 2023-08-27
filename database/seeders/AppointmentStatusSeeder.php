<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seed = [
            [
                'id'=>1,
                'status'=>'waiting'
            ],
            [
                'id'=>2,
                'status'=>'rejecting'
            ],  [
                'id'=>3,
                'status'=>'accepting'
            ],
        ];
        DB::table('appointment_statuses')->insert($seed);
    }
}
