<?php


use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\TeacherWalletController;
use App\Http\Controllers\Teacher\WorkingTimeController;
use Illuminate\Support\Facades\Route;

/*-----------------------------------------------*/
/*------------------  Teacher  ------------------*/
/*-----------------------------------------------*/

Route::prefix('teacher/')->group(function () {


    Route::middleware(['middleware' => 'setAppLang',])->group(function () {
        Route::group(['middleware' => 'auth:api'], function () {
            Route::middleware('role:teacher')->group(function () {
                Route::get('get-profile', [TeacherController::class, 'getProfile']);
                Route::get('get-wallet', [TeacherWalletController::class, 'getWallet']);
            });
            Route::get('get-my-languages', [TeacherController::class, 'getMyLanguages']);
            Route::post('assign-working-time', [WorkingTimeController::class, 'assignWorkingTime']);
            Route::post('beTeacher', [TeacherController::class, 'beTeacher']);
            Route::middleware('role:owner|admin')->group(function () {
                Route::post('accept-teacher', [TeacherController::class, 'acceptTeacher']);
            });
        });
        Route::post('get-teachers-requests', [TeacherController::class, 'getTeachersRequestsByStatuses']);
        Route::get('get-teacher-request/{id}', [TeacherController::class, 'getTeacherRequest']);
        Route::get('get-teachers/', [TeacherController::class, 'getTeachers']);
        Route::get('get-teacher/{id}', [TeacherController::class, 'getTeacher']);
    });
});

