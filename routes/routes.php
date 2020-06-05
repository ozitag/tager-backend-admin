<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['passport:administrators', 'auth:api']], function () {
    Route::get('/self', 'Admin\Core\SelfController@index');
    Route::post('/self/logout', 'Admin\Core\SelfController@logout');
});
