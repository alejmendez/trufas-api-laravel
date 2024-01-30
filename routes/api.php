<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\QuarterController;
use App\Http\Controllers\PlantController;


Route::group([
    'middleware' => ['api', 'cors'],
], function ($router) {
    Route::group([
        'prefix' => 'auth'
    ], function ($router) {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });

    Route::group([
        'middleware' => ['jwt.verify'],
    ], function ($router) {
        Route::apiResources([
            'user' => UserController::class,
            'field' => FieldController::class,
            'quarter' => QuarterController::class,
            'plant' => plantController::class,
        ]);
    });
});
