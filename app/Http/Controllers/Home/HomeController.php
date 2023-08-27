<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionsResource;
use App\Http\Resources\TeacherResource;
use App\Models\Questions;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    function getBestTeacher()
    {
        try {
            $topTeachersWithQuestions = Teacher::where('teacher_status_id',1)->with('languages')->withCount('questions')
                ->orderByDesc('questions_count')
                ->take(9)
                ->get();
            return $this->success(TeacherResource::collection($topTeachersWithQuestions));
        }catch (\Exception $e) {
            return $this->error(errors:$e->getMessage());
        }

    }
    function getBestQuestions()
    {
        try {
            $topQuestions = Questions::select('questions.*')
                ->addSelect(DB::raw('(SELECT COUNT(*) FROM user_questions WHERE user_questions.question_id = questions.id) as user_count'))
                ->orderByDesc('user_count')
                ->take(5)
                ->get();
            return $this->success(QuestionsResource::collection($topQuestions));
        }catch (\Exception $e) {
            return $this->error(errors: $e->getMessage());
        }

    }

    function test()
    {
        try {
            $topTeachersWithQuestions = User::get();
            return $this->success(data: $topTeachersWithQuestions);
        }catch (\Exception $e) {
            return $this->error(errors:$e->getMessage());
        }

    }
}
