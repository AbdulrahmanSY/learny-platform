<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seed = array(
            array('type_name' => 'Master\'s'),
            array('type_name' => 'Doctorate'),
            array('type_name' => 'Diploma'),
            array('type_name' => 'Training course'),
        );

        DB::table('certificate_types')->insert($seed);
    }
}
