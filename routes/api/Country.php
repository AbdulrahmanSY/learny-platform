<?php

use App\Http\Controllers\Helper\CountryController;
use Illuminate\Support\Facades\Route;

/*-----------------------------------------------*/
/*------------------  Country  ------------------*/
/*-----------------------------------------------*/
Route::prefix('country/')->group(function () {
    Route::middleware(['setAppLang','auth:api'])->group(function () {
        Route::get('getCountries', [CountryController::class, 'getCountries']);
        Route::middleware('role:owner|admin')->group(function () {
            Route::delete('delete-country/{id}', [CountryController::class, 'deleteCountry']);
            Route::post('add-country', [CountryController::class, 'addCountry']);
        });
    });
});
