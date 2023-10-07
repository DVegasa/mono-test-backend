<?php

use App\Http\Controllers\CarsController;
use App\Http\Controllers\ClientsController;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->group(function () {
    Route::get('/ping', fn() => response(['ping' => 'pong']));

    Route::prefix('/cars')->group(function () {
        Route::get('/get', [CarsController::class, 'get']);
        Route::get('/getList', [CarsController::class, 'getList']);
        Route::post('/create', [CarsController::class, 'create']);
        Route::post('/update', [CarsController::class, 'update']);
        Route::post('/delete', [CarsController::class, 'delete']);
    });

    Route::prefix('/clients')->group(function () {
        Route::get('/get', [ClientsController::class, 'get']);
        Route::get('/getList', [ClientsController::class, 'getList']);
        Route::post('/create', [ClientsController::class, 'create']);
        Route::post('/update', [ClientsController::class, 'update']);
        Route::post('/delete', [ClientsController::class, 'delete']);
    });
});
