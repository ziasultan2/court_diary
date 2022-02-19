<?php

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function() {
    Route::post('auth/login', 'AuthController@login');
    Route::group(['middleware' => 'auth:sanctum'], function () {
        // Auth routes
    });
});