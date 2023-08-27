<?php


use App\Http\Controllers\Helper\LevelController;
use Illuminate\Support\Facades\Route;

/*-----------------------------------------------*/
/*-------------------  Level  -------------------*/
/*-----------------------------------------------*/
Route::prefix('level/')->group(function () {

        Route::middleware(['setAppLang', 'auth:api'])->group(function () {
            Route::get('get-levels',[LevelController::class,'getLevels']);
            Route::middleware('role:owner|admin')->group(function () {
                Route::post('add-level',[LevelController::class,'addLevel']);
                Route::delete('delete-level/{id}',[LevelController::class,'deleteLevel']);
            });
        });

});
