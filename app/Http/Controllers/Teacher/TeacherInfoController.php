<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TeacherInfoController extends Controller
{
    public static function createTeacherInfo($teacher , $info){

        $video_url = handleFile($info['video'],'teacher/demonstration_video/');
        $teacher->info()->create([
            'about' => $info['about'],
            'teaching_description' => $info['teaching_description'],
            'video' => $video_url,
        ]);
    }

}
