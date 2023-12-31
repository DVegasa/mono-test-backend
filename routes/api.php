<?php

use App\Http\Controllers\CarsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->group(function () {
    Route::get('/ping', [DevController::class, 'ping']);
    Route::get('/errorPing', [DevController::class, 'errorPing']);

    Route::prefix('/cars')->group(function () {
        Route::post('/create', [CarsController::class, 'create']);
        Route::post('/delete', [CarsController::class, 'delete']);
        Route::get('/getList', [CarsController::class, 'getList']);
        Route::get('/get', [CarsController::class, 'get']);
        Route::post('/update', [CarsController::class, 'update']);
    });

    Route::prefix('/clients')->group(function () {
        Route::post('/create', [ClientsController::class, 'create']);
        Route::post('/delete', [ClientsController::class, 'delete']);
        Route::get('/getList', [ClientsController::class, 'getList']);
        Route::get('/get', [ClientsController::class, 'get']);
        Route::post('/update', [ClientsController::class, 'update']);
    });

    Route::prefix('/parking')->group(function () {
        Route::post('/switchParking', [ParkingController::class, 'switchParking']);
    });

    Route::prefix('/stats')->group(function () {
        Route::get('/all', [StatsController::class, 'all']);
    });
});
