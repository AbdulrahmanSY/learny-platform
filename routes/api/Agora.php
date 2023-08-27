<?php

use App\Http\Controllers\Agora\AgoraController;
use Illuminate\Support\Facades\Route;

/*-----------------------------------------------*/
/*-------------------  Agora  -------------------*/
/*-----------------------------------------------*/
Route::prefix('agora/')->group(function () {
    Route::middleware(['setAppLang'],)->group(function () {
        Route::get('get-session-info/{id}', [AgoraController::class, 'getSessionInfo']);
    });
});
