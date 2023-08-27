<?php

use App\Http\Controllers\Content\ContentLevelController;
use App\Http\Controllers\Content\ParagraphCategoryController;
use App\Http\Controllers\Content\ParagraphController;
use App\Http\Controllers\Content\PostController;
use App\Http\Controllers\Content\QuestionsController;
use App\Http\Controllers\Content\TypePostController;
use App\Http\Controllers\Helper\CategoryController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;


Route::prefix('content/')->group(function () {
    Route::get('getContentLevel', [ContentLevelController::class, 'getContentLevel']);
    Route::get('getCategory', [CategoryController::class, 'getCategory']);

    Route::prefix('question/')->group(function () {
        Route::middleware(['setAppLang', 'auth:api'])->group(function () {
            Route::get('getAllQuestion', [QuestionsController::class, 'getAllQuestion']);
            Route::post('solveQuestion', [QuestionsController::class, 'solveQuestion']);
            Route::middleware('role:teacher')->group(function () {
                Route::get('getQuestion/{id}', [QuestionsController::class, 'getQuestion']);
                Route::post('createQuestion', [QuestionsController::class, 'createQuestion']);
                Route::get('getMyQuestion', [QuestionsController::class, 'getMyQuestion']);
                Route::delete('deleteQuestion/{Id}', [QuestionsController::class, 'deleteQuestion']);
                Route::post('editQuestion', [QuestionsController::class, 'editQuestion']);

            });
        });
    });
    Route::prefix('paragraph/')->group(function () {
        Route::middleware(['setAppLang', 'auth:api'])->group(function () {
            Route::get('getParagraphCategory', [ParagraphCategoryController::class, 'getParagraphCategory']);
            Route::post('appreciation', [ParagraphController::class, 'addAppreciation']);
            Route::get('getAllParagraph', [ParagraphController::class, 'getAllParagraph']);
            Route::middleware('role:teacher|admin')->group(function () {
                Route::get('getParagraph/{id}', [ParagraphController::class, 'getParagraph']);
                Route::post('addParagraph', [ParagraphController::class, 'createParagraph']);
                Route::post('editParagraph', [ParagraphController::class, 'editParagraph']);
                Route::get('getMyParagraph', [ParagraphController::class, 'getMyParagraph']);
                Route::get('deleteParagraph/{id}', [ParagraphController::class, 'deleteParagraph']);
            });
        });
    });

    Route::prefix('post/')->group(function () {
        Route::middleware(['setAppLang', 'auth:api'])->group(function () {

            Route::get('get-all-post', [PostController::class, 'getAllPost']);
              Route::middleware('role:teacher|admin')->group(function () {
                Route::post('add-post', [PostController::class, 'addPost']);
                Route::get('get-post-type', [TypePostController::class, 'getPostType']);
                Route::get('get-my-post', [PostController::class, 'getMyPost']);
                Route::delete('delete-post/{id}', [PostController::class, 'deletePost']);
                Route::get('get-post/{id}', [PostController::class, 'getPost']);

              });
        });
    });
});
