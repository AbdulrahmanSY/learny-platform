<?php

namespace Database\Seeders;

use App\Models\Paragraph;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParagraphSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Paragraph::factory()->count(50)->create();
    }
}
