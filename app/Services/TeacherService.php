<?php

namespace App\Services;

use App\Mail\AcceptTeacherMail;
use App\Mail\RejectTeacherMail;
use App\Models\Appointment;
use App\Models\Role;
use App\Models\Teacher;
use App\Traits\ApiResponderTrait;
use Carbon\Exceptions\NotACarbonClassException;
use Carbon\Traits\Date;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use phpseclib3\Math\BigInteger\Engines\PHP;

class TeacherService
{
    use ApiResponderTrait;

    public function changeTeacherStatus( $teacher, $status)
    {
        try {
            if ($teacher['status']['id'] == config('constants.teacher_statuses.pending_id')) {
                if ($status == config('constants.teacher_statuses.accept_id')) {
                    $teacher->updateStatus(config('constants.teacher_statuses.accept_id'));
                    $teacher['user']->assignRole(Role::where('name', config('constants.roles.teacher'))->first());
                    sendMail($teacher['user']['email'],new AcceptTeacherMail($teacher['user']['first_name']));
                    return $this->success(message: trans('validation.custom.accept_teacher.accept.response'));
                } else {
                    $name = $teacher['user']['first_name'];
                    $email = $teacher['user']['email'];
                    sendMail($email,new RejectTeacherMail($name));
                    $teacher->delete();
                    return $this->success(message: trans('validation.custom.accept_teacher.reject.response'));
                }
            } else {
                return $this->error(errors: trans('validation.custom.accept_teacher.no_action'));
            }
        } catch (\Exception $e) {
            return $this->notFoundResponse(errors: trans('validation.custom.teacher.not_found'));
        }
    }

    public function getAvailableDays($workingDays,$id)
    {
        $days = [];
        $times = [];
        $todayDate = Carbon::parse(date('Y-m-dH:i'));
        $todayDateAfterMonth = Carbon::parse(\date('Y-m-dH:i'))->addMonth();
        $data = Appointment::selectRaw("GROUP_CONCAT(DATE_FORMAT(time, '%H:%i') SEPARATOR ',') as times, date")
            ->where('teacher_id',$id)
            ->where('date', '>=', \date('y-m-d'))
            ->where('date', '<=', Carbon::parse(\date('Y-m-d'))->addMonth())
            ->groupBy('date')
            ->get();

        $appointments = [];

        foreach ($data as $appointment) {
            $appointments[$appointment->date] = explode(',', $appointment->times);
        }

        foreach ($workingDays as $workingDay) {
            $date = Carbon::parse(\date('Y-m-dH:i'))
                ->setISODate($todayDate->year, $todayDate->weekOfYear, $workingDay->day_id-1);
            while ($date <= $todayDateAfterMonth) {
                if ($date < $todayDate) {
                    $date->addWeek();
                    continue;
                }
                $dateString = $date->toDateString();
                $this->getAvailableTimes($workingDay['workingTimes'], $times, $date);
                $days[$dateString] = $times;
                $times = [];
                $date->addWeek();
            }
        }
        ksort($days);

        $result = [];

        foreach ($days as $date => $times) {
            if (isset($appointments[$date])) {
                $result[$date] = array_values(array_diff($times, $appointments[$date]));
            } else {
                $result[$date] = $times;
            }
        }

        return $result;
    }

    private function getAvailableTimes($workingTimes, &$times,  $date)
    {
        foreach ($workingTimes as $workingTime) {
            $this->getIntervalTimes($workingTime, $times, $date);
        }
    }

    private function getIntervalTimes($workingTime, &$times, $date)
    {
        $first = new DateTime($workingTime->first);

        $end = new DateTime($workingTime->end);
        $interval = new DateInterval('PT1H');
        while ($first < $end) {

            if (date('Y-m-d') == $date->toDate()->format('Y-m-d')) {
                if ($first < $date) {
                    $first->add($interval);
                    continue;
                }
            }
            $times[] = $first->format('H:i');
            $first->add($interval);
        }
    }

}
