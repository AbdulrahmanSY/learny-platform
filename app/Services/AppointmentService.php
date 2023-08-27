<?php

namespace App\Services;

use App\Mail\AcceptAppointmentMail;
use App\Mail\RejectAppointmentMail;
use App\Mail\RejectTeacherMail;
use App\Models\Appointment;
use App\Models\Teacher;
use App\Models\TeacherWallet;
use App\Models\User;
use App\Traits\ApiResponderTrait;
use Faker\Core\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use TomatoPHP\LaravelAgora\Services\Agora;
use Yasser\Agora\RtcTokenBuilder;

class AppointmentService
{
    use ApiResponderTrait;

    public function bookingAbility($user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            if ($user->hours > 0) {
                $user->hours -= 1;
                $user->save();
                return true;
            } else
                return false;
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function changeAppointmentStatus(Appointment $appointment, $status)
    {
        try {
            DB::beginTransaction();
            $user = $appointment->user;

            if ($status == config('constants.appointments.statuses.waiting_id')
                || $appointment->status_id == config('constants.appointments.statuses.accepted_id')
                || $appointment->status_id == config('constants.appointments.statuses.rejected_id')) {

                return $this->badRequestResponse(errors: 'There is no action to do on this appointment');
            }
            $appointment->update([
                'status_id' => $status
            ]);
            $user_id = Auth()->id();
            $teacher = Teacher::where('user_id', $user_id)->first();
            if($status == config('constants.appointments.statuses.accepted_id')){

                TeacherWallet::create([
                    'teacher_id' => $teacher->id,
                    'number_of_hours' => 1,
                    'actual_of_hours' => 1,
                    'price' => 40,
                    'withdraw_money' => 0,
                ]);
            }

            if ($status == config('constants.appointments.statuses.accepted_id')) {
                sendMail($user->email, new AcceptAppointmentMail($user->first_name));
                $uuid = Str::uuid();
                $channel_name = Str::random(10);
                $token = (new AgoraService)->generateToken($channel_name);
                $appointment->session()->create(
                    [
                        'id' => $uuid,
                        'channel_name' => $channel_name,
                        'token' => $token,
                    ]
                );
            } else {
                $user->hours += 1;
                $user->save();
                sendMail($user->email, new RejectAppointmentMail($user->first_name));
            }
            DB::commit();
            return $this->success(message: 'The status change successfully');
        } catch (\Exception $exception) {
            return $this->error(errors: $exception->getMessage());
        }
    }


}

