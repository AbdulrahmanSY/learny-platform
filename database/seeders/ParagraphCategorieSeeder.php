<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParagraphCategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = [
            ['type_en'=>'Scientific','type_ar'=>'علمية']  ,
            ['type_en'=>'anecdotal','type_ar'=>'موضوعية']  ,
            ['type_en'=>'descriptive','type_ar'=>'وصفية']  ,
            ['type_en'=>'subjectivity','type_ar'=>'ذاتية']  ,
        ];
        DB::table('paragraph_categories')->insert($type);
    }
}
