<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Teacher\WorkingTimeController;
use Illuminate\Support\Facades\Route;

/*-----------------------------------------------*/
/*--------------------  User  -------------------*/
/*-----------------------------------------------*/
Route::prefix('user/')->group(function (){
    Route::group(['middleware' => ['api'],], function () {
        Route::group(['middleware'=>'auth:api'],function (){

        });
        Route::get('get-users',[UserController::class,'getUsers']);
        Route::get('get-user/{id}',[UserController::class,'getUser']);

    });
});
