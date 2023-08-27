<?php

use App\Http\Controllers\Helper\GoalController;
use Illuminate\Support\Facades\Route;


Route::prefix('Goal/')
    ->middleware(['setAppLang', 'auth:api'])
    ->group(function () {
        Route::Get('getAllGoal', [GoalController::class, 'getAllGoal']);
        Route::middleware('role:owner|admin')->group(function () {
            Route::post('addGoal', [GoalController::class, 'addGoal']);
            Route::post('updateGoal/{id}', [GoalController::class, 'updateGoal']);
            Route::Get('getGoal/{id}', [GoalController::class, 'getGoal'],);
            Route::Get('deleteGoal/{id}', [GoalController::class, 'deleteGoal'],);
        });
    });
