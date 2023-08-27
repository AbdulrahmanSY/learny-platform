<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\AppointmentRequest;
use App\Http\Requests\Appointment\ChangeAppointmentStateRequest;
use App\Http\Requests\Appointment\GetAllAppointmentByStatus;
use App\Http\Requests\Appointment\UpdateApointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Mail\BookingAppointmentMail;
use App\Models\Appointment;
use App\Models\Teacher;
use App\Services\AppointmentService;
use App\Services\FileService;
use Exception;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function bookingAppointment(AppointmentRequest $request)
    {

        try {
            DB::beginTransaction();
            if (!(new AppointmentService)->bookingAbility(auth()->id())) {
                return $this->badRequestResponse(errors: "You don't have enough hour for booking appointment");
            }
            $user_id = Auth()->id();
            $appointment = Appointment::create([
                'user_id' => $user_id,
                "status_id" => config('constants.appointments.status_default'),
                "period_id" => $request->get('period_id'),
                "teacher_id" => $request->get('teacher_id'),
                'language_id' => $request->get('language_id'),
                "level_id" => $request->get('level_id'),
                "goal_id" => $request->get('goal_id'),
                "date" => $request->get('date'),
                "time" => $request->get('time'),
                "description" => $request->get('description'),
            ]);
            (new FileService)->fileStore($appointment, $request->get('files'));
            $teacher = Teacher::findOrFail($request->get('teacher_id'))->load('user');
            sendMail($teacher['user']->email, new BookingAppointmentMail($teacher->user->first_name));
            DB::commit();
            return $this->createdResponse();
        } catch (Exception $exception) {
            return $this->error(errors: $exception->getMessage());
        }
    }

    public function getAppointments(GetAllAppointmentByStatus $status): \Illuminate\Http\JsonResponse
    {
        try {
            $user_id = Auth()->id();
            $query = Appointment::where('user_id', $user_id)
                ->with('files', 'teacher', 'appointmentStatus', 'goal', 'level')
                ->orderBy('created_at', 'desc');

            if ($status->input('status_id') != null) {
                $query->AppointmentFilter($status->input('status_id'));
            }
            $user_booking_appointment = $query->paginate(config('constants.appointment.paginate'));

            return $this->success(AppointmentResource::collection($user_booking_appointment));
        } catch (Exception $exception) {
            return $this->error(errors: $exception->getMessage());
        }
    }

    public function getTeacherAppointments()
    {

        $statuses = explode(',', request()->query('statuses')) ?? config('constants.appointments.status_default');
        try {
            $teacher = Teacher::where('user_id', auth()->id())->firstOrfail();
            $appointments = Appointment::where('teacher_id', $teacher->id)
                ->with('appointmentStatus', 'period', 'user')
                ->AppointmentFilter($statuses)
                ->orderBy('created_at', 'desc')
                ->paginate(config('constants.panel.pagination.per_page'));
            return AppointmentResource::collection($appointments);
        } catch (Exception $exception) {
            return $statuses;
        }
    }

    public function getTeacherAppointment($id)
    {
        try {
            $teacher = Teacher::where('user_id', auth()->id())->first();
            $appointment = Appointment::with(['level', 'goal', 'files', 'user', 'period', 'appointmentStatus'])
                ->where('teacher_id', $teacher->id)
                ->where('id', $id)
                ->findOrFail($id);
            return new AppointmentResource($appointment);
        } catch (Exception $exception) {
            return $this->notFoundResponse(errors: trans('validation.custom.appointment.not_found'));
        }
    }

    public function getStudentAppointments()
    {
        $statuses = explode(',', request()->query('statuses')) ?? config('constants.appointments.status_default');
        try {
            $appointments = Appointment::where('user_id', auth()->id())
                ->with('appointmentStatus', 'teacher')
                ->AppointmentFilter($statuses)
                ->orderBy('created_at', 'desc')
                ->paginate(config('constants.panel.pagination.per_page'));
            return AppointmentResource::collection($appointments);
        } catch (Exception $exception) {
            return $this->error(errors: $exception->getMessage());
        }
    }

    public function getStudentAppointment($id)
    {
        try {
            $appointment = Appointment::with(['level', 'goal', 'files', 'teacher', 'period', 'appointmentStatus'])
                ->where('user_id', auth()->id())
                ->where('id', $id)
                ->findOrFail($id);
            return new AppointmentResource($appointment);
        } catch (Exception $exception) {
            return $this->notFoundResponse(errors: trans('validation.custom.appointment.not_found'));
        }
    }

    public function updateBookingAppointment(UpdateApointmentRequest $request, Appointment $appointment)
    {
        DB::beginTransaction();
        try {
            $user_id = Auth()->id();
            $appointment = Appointment::find($request->id);
            if ($appointment && $appointment->user_id == $user_id) {
                $appointment->update([
                    "status_id" => config('constants.appointments.status_default'),
                    "period_id" => $request->get('period_id', $appointment->period_id),
                    "teacher_id" => $request->get('teacher_id', $appointment->teacher_id),
                    "level_id" => $request->get('level_id', $appointment->level_id),
                    "goal_id" => $request->get('goal_id', $appointment->goal_id),
                    "date" => $request->get('date', $appointment->date),
                    "time" => $request->get('time', $appointment->time),
                    "description" => $request->get('description', $appointment->description),
                ]);

                if (!empty($request->get('files'))) {
                    foreach ($request->get('files') as $file) {
                        if ($file !== null) {
                            $file_url = handleFile($file, 'session_file/');
                            $appointment->files()->create([
                                'file' => $file_url,
                            ]);
                        }
                    }
                }

                DB::commit();
                return $this->success($appointment);
            } else {
                return $this->error(errors: "Appointment not found or you don't have permission to update this appointment");
            }
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->error(errors: $exception->getMessage());
        }
    }

    public function deleteAppointment(int $id): \Illuminate\Http\JsonResponse
    {
        try {
            if (DB::table('appointments')->where('id', $id)->exists()) {

                DB::table('appointments')->where('id', $id)->delete();
                return $this->success();

            }
            return $this->error(errors: "not exists");
        } catch (Exception $exception) {
            return $this->error(errors: "not exists");
        }
    }

    public function changeAppointmentState(ChangeAppointmentStateRequest $request, AppointmentService $appointmentService)
    {
        try {
            $appointment = Appointment::findOrFail($request->appointment_id);


            return $appointmentService->changeAppointmentStatus($appointment, $request->status_id);
        } catch (Exception $exception) {
            return $this->error(errors: $exception->getMessage());
        }
    }
}
