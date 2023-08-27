<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowRequest;
use App\Http\Resources\TeacherResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    public function getFollowTeachers(): JsonResponse
    {
        try {

            $user = Auth::user();
            if ($user->follow()->exists()) {
                return $this->success(TeacherResource::collection($user->follow()->paginate(10)));
            }
            return $this->success(message: trans('validation.custom.follow.get_teacher'));
        } catch (Exception $ex) {
            return $this->error(errors: $ex->getMessage());
        }
    }

    public function follow(FollowRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $value = $request->validated();
            if ($user->follow()
                ->wherePivot('teacher_id', $value['teacher_id'])->wherePivot('user_id', $user->id)
                ->exists()) {
                $user->follow()->detach($value['teacher_id']);
                DB::commit();
                return $this->success(message: trans('validation.custom.follow.cancel_follow'));
            } else {
                $user->follow()->attach($value['teacher_id']);
                DB::commit();
                return $this->success(message: trans('validation.custom.follow.follow'));
            }

        } catch (Exception $ex) {
            return $this->error(errors: $ex->getMessage());
        }
    }

}
