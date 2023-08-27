<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\PackageHoursController;
use App\Http\Controllers\Home\PlatformInformationController;
use App\Http\Controllers\Home\PlatformServicesController;
use Illuminate\Support\Facades\Route;


Route::prefix('home/')
    ->middleware(['setAppLang'])
    ->group(function () {
    Route::get('get-service', [PlatformServicesController::class, 'getService']);
    Route::get('get-package-hours-price', [PackageHoursController::class, 'getPackageHoursPrice']);
    Route::get('get-info', [PlatformInformationController::class, 'getInfo']);
    Route::get('statistics', [PlatformInformationController::class, 'statistics']);
    Route::get('get-best-teacher', [HomeController::class, 'getBestTeacher']);
    Route::get('get-best-question', [HomeController::class, 'getBestQuestions']);
    Route::get('test', [HomeController::class, 'test']);
});
