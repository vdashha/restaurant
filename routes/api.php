<?php

use App\Http\Controllers\CourierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('/courier')
    ->controller(CourierController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/registration', 'registration');

    Route::middleware('auth:sanctum')->get('/logout', 'logout');
    Route::middleware('auth:sanctum')->get('/deliveries', 'getDeliveries');
    Route::middleware('auth:sanctum')->post('/deliveries/changeStatus', 'changeStatus');
});
