<?php

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
    Route::get('messages', [MessageController::class, "messagesAll"]);
    Route::post('messageById', [MessageController::class, "messageById"]);
    Route::post('messageByPartyId', [MessageController::class, "messageByPartyId"]);
    Route::post('newMessage', [MessageController::class, "messageAdd"]);
    Route::put('updateMessage', [MessageController::class, "messageUpdate"]);
    Route::delete('deleteMessage', [MessageController::class, "messageDelete"]);
});
