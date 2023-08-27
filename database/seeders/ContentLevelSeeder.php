<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = [
            ['level_en' => 'Easy','level_ar' => 'سهل'],
            ['level_en' => 'Normal','level_ar' => 'عادي'],
            ['level_en' => 'Hard','level_ar' => 'صعب'],

        ];
        DB::table('content_levels')->insert($category);
    }
}
