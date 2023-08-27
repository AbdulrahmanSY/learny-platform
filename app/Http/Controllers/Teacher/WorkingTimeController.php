<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\WorkingTimeRequest;
use App\Models\Teacher;
use App\Models\WorkingDay;
use Carbon\Carbon;
use DateInterval;
use DateTime;

class WorkingTimeController extends Controller
{
    public function assignWorkingTime(WorkingTimeRequest $request){
        $data = $request->validated();
        $user_id = auth()->id();
        $teacher = Teacher::all()->where('user_id',$user_id)->first();
        foreach ($data['working_days'] as $working_day){
            $day = $teacher->workingDays()->create(['day_id'=>$working_day['day_id']]);
            foreach ($working_day['working_times'] as $working_time ){
                $day->workingTimes()->create(['first'=>$working_time['first'],'end'=>$working_time['end']]);
            }
        }
        return $this->createdResponse(message: 'Working times created successfully');
    }

}
