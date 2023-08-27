<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlatformInformationResource;
use App\Http\Resources\PlatfromInfromationResouce;
use App\Models\Appointment;
use App\Models\Paragraph;
use App\Models\PlatformInformation;
use App\Models\Post;
use App\Models\Questions;
use App\Models\Role;
use App\Models\Teacher;

class PlatformInformationController extends Controller
{

    public function getInfo()
    {
        return $this->success(new PlatformInformationResource(PlatformInformation::find(1)));
    }

    public function statistics()
    {
        $statistics = [];
        $statistics['teacher'] = Teacher::count();

        $studentRole = Role::where('name', 'student')->first();
        $statistics['user'] = $studentRole->users()->count();

        $statistics['appointment'] = Appointment::count();
        $statistics['content'] = Questions::count() + Paragraph::count() + Post::count();


        return $this->success($statistics);


    }


}
