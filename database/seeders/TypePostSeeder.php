<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypePostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = [
            [
                'type'=>'video'
            ],
            [
                'type'=>'photos'
            ],
            [
                'type'=>'text'
            ],

            [
                'type'=>'PDF'
            ],
        ];
        DB::table('type_posts')->insert($type);
    }
}
