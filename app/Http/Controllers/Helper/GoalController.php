<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\GoalRequest;
use App\Http\Requests\UpdateGoalRequest;
use App\Http\Resources\GoalResource;
use App\Models\Goal;

class GoalController extends Controller
{
    public function getGoal(int $id): \Illuminate\Http\JsonResponse
    {
        if(Goal::where('id', $id)->exists()){

            $Goal = Goal::where('id',$id)->get();
            return $this->success(GoalResource::Collection($Goal));
        }
        return $this->notFoundResponse("not found");

    }
    public function addGoal(goalRequest $request): \Illuminate\Http\JsonResponse
    {
        Goal::create($request->only('goal_name'));
       return $this->success();
    }
    public function deleteGoal(int $id): \Illuminate\Http\JsonResponse
    {
        if(Goal::where('id', $id)->exists()) {
            Goal::where('id', $id)->delete();
            return $this->success();
        }
        return $this->notFoundResponse("not found");
    }
    public function getAllGoal(): \Illuminate\Http\JsonResponse
    {
        $allGoal = Goal::get();
        return $this->success(GoalResource::Collection($allGoal));
    }
    public function updateGoal(GoalRequest $request,int  $id): \Illuminate\Http\JsonResponse
    {

        if(Goal::where('id', $id)->exists()) {
            $goal = Goal::find($id);
            $goal->goal_name = $request->input('goal_name');
            $goal->save();
            return $this->success(GoalResource::Collection(Goal::where('id', $id)->get()));
        }
        return $this->notFoundResponse("not found");
    }
}
