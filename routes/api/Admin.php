<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Teacher\WorkingTimeController;
use Illuminate\Support\Facades\Route;

/*-----------------------------------------------*/
/*-------------------  Admin  -------------------*/
/*-----------------------------------------------*/
Route::prefix('admin/')->group(function () {
    Route::middleware(['setAppLang','auth:api','role:owner'],)->group(function () {
            Route::post('assign-admin/{id}', [AdminController::class, 'assignAdmin']);
    });
});
