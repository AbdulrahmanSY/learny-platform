<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlatformServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $values = [
            ['service_ar'=>'دروس','service_en'=>'Lesson'],
            ['service_ar'=>'أسئلة','service_en'=>'Questions'],
            ['service_ar'=>'مقالات تفاعلية','service_en'=>'Paragraphs'],
            ['service_ar'=>'فيدوهات','service_en'=>'videos'],

        ];
        DB::table('platform_services')->insert($values);
    }
}
