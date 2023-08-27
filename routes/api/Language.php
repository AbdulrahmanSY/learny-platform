<?php


use App\Http\Controllers\Helper\LanguageController;
use Illuminate\Support\Facades\Route;

/*-----------------------------------------------*/
/*------------------  Language  -----------------*/
/*-----------------------------------------------*/
Route::prefix('language/')->group(function () {
    Route::get('get-languages', [LanguageController::class, 'getLanguages']);
    Route::middleware(['setAppLang', 'auth:api'])->group(function () {
        Route::controller(LanguageController::class)->group(function (){
        Route::middleware('role:owner|admin')->group(function () {
            Route::delete('delete-language/{id}', [LanguageController::class, 'deleteLanguage']);
            Route::post('add-language', [LanguageController::class, 'addLanguage']);
        });
       });
    });
});
