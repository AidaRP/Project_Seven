<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
'middleware' => 'jwt.auth'
], function(){

    Route::get('/players', [PlayerController::class, 'playersAll']);
    // Route::get('/players', [PlayerController::class, 'playersAll']);
    
});

//Middleware example
Route::get('/task_middleware', [TaskController::class, 'exampleMiddleware'])->middleware('task_middleware');