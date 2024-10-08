<?php

use App\Http\Controllers\API\ReservaController as APIReservaController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ReservaController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/fazer_reserva', [APIReservaController::class, 'store']);
Route::get('/search_airport', [AppController::class, 'searchCity']);

Route::post('/search_fligths', [FlightController::class, 'searchFlights']);

Route::post('/test', [FlightController::class, 'searchFlights']);