<?php


use App\Http\Controllers\Appointments\AppointmentStatusController;
use Illuminate\Support\Facades\Route;


Route::prefix('appointmentState/')
    ->middleware(['setAppLang', 'auth:api'])
    ->group(function () {
        Route::Get('getAllStatus', [AppointmentStatusController::class, 'getAllStatus']);
        Route::middleware('role:owner|admin')->group(function () {
            Route::post('addStatus', [AppointmentStatusController::class, 'addStatus']);
            Route::post('updateStatus/{id}', [AppointmentStatusController::class, 'updateStatus']);
            Route::Get('getStatus/{id}', [AppointmentStatusController::class, 'getStatus']);
            Route::Get('deleteStatus/{id}', [AppointmentStatusController::class, 'deleteStatus'],);
        });
    });

