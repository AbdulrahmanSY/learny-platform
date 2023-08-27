<?php

namespace App\Http\Controllers\Teacher;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\LanguageController;
use App\Http\Requests\Teacher\AcceptTeacherRequest;
use App\Http\Requests\Teacher\BeTeacherRequest;
use App\Http\Requests\Teacher\TeacherByStatusesRequest;
use App\Http\Resources\LanguageTeacherResource;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use App\Services\TeacherService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function beTeacher(BeTeacherRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        if ($data['info']['first_name'] == $user->first_name && $data['info']['last_name'] == $user->last_name) {
            $user->father_name = $data['info']['father_name'];
            $user->save();
        } else {
            return $this->badRequestResponse(errors: 'Your name is incorrect');
        }
        try {
            DB::beginTransaction();
            try {
                $user_id = Auth()->id();
                $teacher = Teacher::create([
                    'user_id' => $user_id,
                    'teacher_status_id' => config('constants.teacher_statuses.pending_id'),
                    'rating' => config('constants.teacher.default_rating')
                ]);
            } catch (Exception $exception) {
                return $this->error(errors: 'This user is already a teacher');
            }

            TeacherInfoController::createTeacherInfo($teacher, $data['info']);
            CardIDController::createCardID($teacher, $data['card']);
            LanguageController::createTeacherLanguages($teacher, $data['languages']);

            DB::commit();

            return $this->createdResponse(message: 'Teacher created successfully');
        } catch (Exception $exception) {
            return $this->error(errors: $exception->getMessage());

        }
    }

    public function getTeachersRequestsByStatuses(TeacherByStatusesRequest $request)
    {
        $statuses = $request->statuses;
        $statuses = explode(",", $statuses);
        $teachers = Teacher::TeacherStatuses($statuses)->get()->load('user');
        if ($teachers->isEmpty()) {
            return $this->notFoundResponse(errors: 'There is no teachers has this status');
        }
        return $this->success(TeacherResource::collection($teachers));
    }

    public function getTeacherRequest($id)
    {

        $teacher = Teacher::all()->where('id', $id)->load('user')->first();
        if (!isset($teacher)) {
            return $this->notFoundResponse(errors: 'There is no teacher with this ID');
        }
        $teacher->load('languages.certificates.doner', 'info', 'cardId');
        return $this->success(new TeacherResource($teacher));
    }

    public function acceptTeacher(AcceptTeacherRequest $request, TeacherService $teacherService)
    {
        $data = $request->validated();
        $teacher = Teacher::with('status')->with('user')->where('id', $data['teacher_id'])->first();
        return $teacherService->changeTeacherStatus($teacher, $data['status_id']);
    }

    public function getTeachers(Request $request)
    {
        $languages = $request->query('languages');

            $languages ?? $languages = [1];
        $teachers = Teacher::with(['workingDays' => function ($query) {
            $query->orderBy('day_id');
        }, 'user', 'languages', 'status'])->LanguageFilter($languages)
            ->where('teacher_status_id', config('constants.teacher_statuses.accept_id'))->paginate(config('constants.panel.pagination.per_page'));
        return TeacherResource::collection($teachers);
    }

    public function getTeacher($id, TeacherService $teacherService)
    {
        $teacher = Teacher::with('workingDays')->find($id);
        if (isset($teacher)) {
            $teacher->load('languages.certificates', 'info', 'user');
            $daysAndTimes = $teacherService->getAvailableDays($teacher['workingDays'], $teacher->id);
            return new TeacherResource($teacher, $daysAndTimes);
        } else {
            return $this->notFoundResponse(errors: trans('validation.custom.teacher.not_found'));
        }

    }

    public function getMyLanguages(): JsonResponse
    {
        try {
            $user_id = Auth()->id();
            $teacher = Teacher::where('user_id', $user_id)->with('mylanguages')->first();

            return $this->success(LanguageTeacherResource::collection($teacher->mylanguages));

        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    function getProfile(){
        try {
        $user_id = Auth()->id();
        $teacher = Teacher::where('user_id', $user_id)->with('user','info','status','workingDays',
        'appointments')->first();

        return $this->success($teacher);

        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }

    }

}
