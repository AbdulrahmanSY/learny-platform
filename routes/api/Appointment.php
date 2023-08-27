<?php

use App\Http\Controllers\Appointments\AppointmentController;
use App\Http\Requests\Appointment\AppointmentRequest;
use Illuminate\Support\Facades\Route;


Route::prefix('appointment/')
    ->middleware(['setAppLang', 'auth:api'])
    ->group(function () {
        Route::post('booking-appointment', [AppointmentController::class, 'bookingAppointment']);
        Route::middleware('role:teacher')->group(function (){
            Route::get('get-teacher-appointment/{id}', [AppointmentController::class, 'getTeacherAppointment']);
            Route::get('get-teacher-appointments', [AppointmentController::class, 'getTeacherAppointments']);
        });
        Route::middleware('role:student')->group(function (){
            Route::get('get-student-appointment/{id}', [AppointmentController::class, 'getStudentAppointment']);
            Route::get('get-student-appointments', [AppointmentController::class, 'getStudentAppointments']);
        });
        Route::post('get-all-appointments', [AppointmentController::class, 'getAppointments'])->middleware('role:owner:admin');
        Route::put('update-appointment', [AppointmentController::class, 'updateBookingAppointment']);
        Route::Get('delete-appointment/{id}', [AppointmentController::class, 'deleteAppointment'],);
        Route::post('change-appointment-state', [AppointmentController::class, 'changeAppointmentState'],);
    });
