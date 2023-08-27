<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = [
            ['category_name' => 'Grammar',
                'description' => 'Parts of Speech,Sentence Structure,Tenses,Conditionals and Reported Speech',
                'language_id' => 1],

            ['category_name' => 'Vocabulary',
                'description' => 'Basic Vocabulary,Academic Vocabulary,Technical Vocabulary,Slang and Informal Vocabulary and Idioms and Expressions',
                'language_id' => 1],

            ['category_name' => 'Translate',
                'description' => 'Pronunciation,Listening Comprehension,Speaking Fluency and Conversation Skills',
                'language_id' => 1],

            ['category_name' => 'Sorting',
                'description' => 'Pronunciation,Listening Comprehension,Speaking Fluency and Conversation Skills',
                'language_id' => 1],

            ['category_name' => 'قواعد',
                'description' => 'الازمنة,الجملة الاسمية و الفعلية ',
                'language_id' => 2],

            ['category_name' => 'مفردات',
                'description' => 'اب ت',
                'language_id' => 2],

            ['category_name' => 'ترجمة',
                'description' => 'اب ت',
                'language_id' => 2],

            ['category_name' => 'فرز',
                'description' => 'اب ت',
                'language_id' => 2],

        ];
        DB::table('categories')->insert($category);
    }
}
