<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['provider:administrators', 'auth:api']], function () {
    Route::get('/self', OZiTAG\Tager\Backend\Admin\Controllers\SelfController::class . '@getProfile');
    Route::post('/self', OZiTAG\Tager\Backend\Admin\Controllers\SelfController::class . '@updateProfile');
    Route::post('/self/password', OZiTAG\Tager\Backend\Admin\Controllers\SelfController::class . '@changePassword');
    Route::post('/self/logout', OZiTAG\Tager\Backend\Admin\Controllers\SelfController::class . '@logout');

    Route::apiResource('admins', \OZiTAG\Tager\Backend\Admin\Controllers\AdminsController::class);
});

