<?php

namespace Database\Seeders;

use App\Models\Answers;
use App\Models\Questions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Questions::factory()
            ->count(200)
            ->has(Answers::factory()->count(4), 'answer')
            ->create();
    }
}
