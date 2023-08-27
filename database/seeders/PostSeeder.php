<?php

namespace Database\Seeders;

use App\Models\FilesPost;
use App\Models\Post;
use Database\Factories\FilesPostFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory(200)->create()
            ->each(function ($post){
                $post->file()->create([
                    'post_id'=>$post->id,
                    'file'=>$post->type_id==1?'/constants/demo/demo.mp4':'/constants/appointment_images/undraw_Audio_conversation_re_3t38.png'
                ]);
            });
    }
}
