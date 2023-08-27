<?php


use App\Http\Controllers\Certificate\CertificateTypeController;
use App\Http\Controllers\Helper\DonerTypeController;
use Illuminate\Support\Facades\Route;

/*-----------------------------------------------*/
/*----------------  Certificate  ----------------*/
/*-----------------------------------------------*/
Route::prefix('certificate/')->group(function () {

    Route::middleware(['setAppLang', 'auth:api'])->group(function () {
        Route::get('get-types', [CertificateTypeController::class, 'getCertificateTypes']);
        Route::middleware('role:owner|admin')->group(function () {
            Route::delete('delete-certificate-type/{id}', [CertificateTypeController::class, 'deleteCertificateTypes']);
            Route::post('add-certificate-type', [CertificateTypeController::class, 'addCertificateType']);
        });
        Route::prefix('doner/')->group(function () {
            Route::get('get-doner-types', [DonerTypeController::class, 'getDonerTypes']);
            Route::middleware('role:owner|admin')->group(function () {
                Route::delete('delete-doner-type/{id}', [DonerTypeController::class, 'deleteDonerType']);
                Route::post('add-doner-type', [DonerTypeController::class, 'addDonerType']);
            });
        });
    });
});
