<?php


use App\Http\Controllers\Helper\NationalityController;
use Illuminate\Support\Facades\Route;

/*-----------------------------------------------*/
/*-----------------  Nationality  ---------------*/
/*-----------------------------------------------*/
Route::prefix('nationality/')->group(function () {
    Route::middleware(['setAppLang', 'auth:api'])->group(function () {

            Route::get('get-nationalities', [NationalityController::class, 'getNationalities']);
            Route::middleware('role:owner|admin')->group(function () {
                Route::delete('delete-nationality/{id}', [NationalityController::class, 'deleteNationality']);
                Route::post('add-nationality', [NationalityController::class, 'addNationality']);
            });

    });
});
