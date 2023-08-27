<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['price' => 40, 'currency' => 'Rial', 'symbol' => 'SAR']

        ];
        DB::table('price_hours')->insert($values);
    }
}

