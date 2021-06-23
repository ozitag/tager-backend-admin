<?php

use Illuminate\Support\Facades\Route;

use OZiTAG\Tager\Backend\Auth\Http\Controllers\AuthLogController;
use OZiTAG\Tager\Backend\Admin\Controllers\SelfController;
use OZiTAG\Tager\Backend\Files\TagerBackendFilesController;

Route::group(['prefix' => 'admin', 'middleware' => ['passport:administrators', 'auth:api']], function () {
    Route::post('/upload', [TagerBackendFilesController::class, 'upload']);
    Route::get('/auth-logs/{provider_string}', [AuthLogController::class, 'index']);

    Route::get('/self', [SelfController::class, 'getProfile']);
    Route::post('/self', [SelfController::class, 'updateProfile']);
    Route::post('/self/password', [SelfController::class, 'changePassword']);
    Route::post('/self/logout', [SelfController::class, 'logout']);
});
