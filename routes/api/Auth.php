<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;

/*-----------------------------------------------*/
/*--------------------  AUTH  -------------------*/
/*-----------------------------------------------*/
Route::group(['middleware' => ['setAppLang']], function () {

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('send-otp', [VerificationController::class, 'sendOtp']);
Route::post('check-otp', [VerificationController::class, 'checkOtp']);
Route::post('forget-password', [UserController::class, 'forgetPassword']);
Route::post('verify-account', [UserController::class, 'verifyAccount']);
Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout', [UserController::class, 'logout']);
    Route::post('delete-account', [UserController::class, 'deleteAccount']);
    Route::post('change-password', [UserController::class, 'changePassword']);



    Route::post('beTeacher', [TeacherController::class, 'beTeacher']);


});

});

