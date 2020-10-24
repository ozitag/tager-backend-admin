<?php

use Illuminate\Support\Facades\Route;

use OZiTAG\Tager\Backend\Admin\Controllers\SelfController;
use OZiTAG\Tager\Backend\Admin\Controllers\UploadController;

Route::group(['prefix' => 'admin', 'middleware' => ['passport:administrators', 'auth:api']], function () {
    Route::post('/upload', [UploadController::class, 'index']);

    Route::get('/self', [SelfController::class, 'getProfile']);
    Route::post('/self', [SelfController::class, 'updateProfile']);
    Route::post('/self/password', [SelfController::class, 'changePassword']);
    Route::post('/self/logout', [SelfController::class, 'logout']);
});
