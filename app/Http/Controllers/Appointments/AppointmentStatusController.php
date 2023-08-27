<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\Appointment_statusRequest;
use App\Http\Requests\UpdateAppointment_statusRequest;
use App\Http\Resources\AppointmentStatusResource;
use App\Models\AppointmentStatus;

class AppointmentStatusController extends Controller
{
    public function getStatus(int $id): \Illuminate\Http\JsonResponse
    {
        if(AppointmentStatus::where('id', $id)->exists()){

            $status = AppointmentStatus::where('id',$id)->get();
            return $this->success(AppointmentStatusResource::collection($status));
        }
        return $this->notFoundResponse("not found");

    }
    public function addStatus(Appointment_statusRequest $request): \Illuminate\Http\JsonResponse
    {
        AppointmentStatus::create($request->only('status'));
        return $this->success();
    }
    public function deleteStatus(int $id): \Illuminate\Http\JsonResponse
    {
        if(AppointmentStatus::where('id', $id)->exists()) {
            AppointmentStatus::where('id', $id)->delete();
            return $this->success();
        }
        return $this->notFoundResponse("not found");
    }
    public function getAllStatus(): \Illuminate\Http\JsonResponse
    {
        $allStatus = AppointmentStatus::get();
        return $this->success(AppointmentStatusResource::collection($allStatus));
    }
    public function updateStatus(Appointment_statusRequest $request,int  $id): \Illuminate\Http\JsonResponse
    {

        if(AppointmentStatus::where('id', $id)->exists()) {
            $status = AppointmentStatus::find($id);
            $status->status = $request->input('status');
            $status->save();
            return $this->success(AppointmentStatusResource::collection(AppointmentStatus::where('id', $id)->get()));
        }
        return $this->notFoundResponse("not found");
    }
}
