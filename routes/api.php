<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\AquariumController;
use App\Http\Controllers\Api\SensorController;
use App\Http\Controllers\Api\MeasurementController;
use App\Http\Controllers\Api\SensorTypeController;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('aquariums', AquariumController::class);
    Route::apiResource('sensors', SensorController::class);
    Route::apiResource('measurements', MeasurementController::class);
    Route::apiResource('sensorTypes', SensorTypeController::class);
});
