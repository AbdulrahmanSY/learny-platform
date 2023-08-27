<?php

use App\Http\Controllers\FollowController;
use Illuminate\Support\Facades\Route;

Route::prefix('follow/')->group(function () {
    Route::middleware(['setAppLang', 'auth:api'])->group(function () {
        Route::post('follow', [FollowController::class, 'follow']);
        Route::post('cancel_follow', [FollowController::class, 'cancelFollow']);
        Route::get('get_follow_teachers', [FollowController::class, 'getFollowTeachers']);
    });
});
