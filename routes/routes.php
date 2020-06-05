<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['passport:administrators', 'auth:api']], function () {
    Route::get('/self', OZiTAG\Tager\Backend\Admin\Controllers\SelfController::class . '@index');
    Route::post('/self/logout', OZiTAG\Tager\Backend\Admin\Controllers\SelfController::class . '@logout');
});
