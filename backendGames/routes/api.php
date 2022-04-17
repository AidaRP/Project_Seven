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

Route::middleware('auth:api')->group(function (){
   

    Route::get('playersAll', [PlayerController::class, 'playersAll']);
    Route::post('playerByID', [PlayerController::class, "playerByID"]);
    Route::put('playerUpdate',[PlayerController::class,"playerUpdate"]);
    Route::delete('playerDelete',[PlayerController::class,"playerDelete"]);
    
});

//Middleware example
Route::get('/task_middleware', [TaskController::class, 'exampleMiddleware'])->middleware('task_middleware');