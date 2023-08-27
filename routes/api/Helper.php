<?php


use App\Http\Controllers\Helper\DayController;
use App\Http\Controllers\Helper\PeriodController;
use Illuminate\Support\Facades\Route;

/*-----------------------------------------------*/
/*-------------------  Helper  ------------------*/
/*-----------------------------------------------*/
Route::prefix('helper/')->group(function () {
    Route::middleware(['setAppLang', 'auth:api'])->group(function () {
        Route::get('get-days',[DayController::class,'getDays']);
        Route::get('get-periods',[PeriodController::class,'getPeriods']);

    });
});
