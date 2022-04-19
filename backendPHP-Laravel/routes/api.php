<?php

// use App\Http\Controllers\AuthController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, "userRegister"]);

Route::post('/login', [AuthController::class, "login"]);




Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::post('/logout', [AuthController::class, "logout"]);

    Route::get('/profile', [AuthController::class, 'profile']);

    Route::get('/users', [UserController::class, 'allUsers']);

    Route::get('/users/{id}', [UserController::class, 'userByID']);

    Route::put('/users/{id}', [UserController::class, 'updateUser']);

    Route::delete('/users/{id}', [UserController::class, 'deleteUser']);
});

Route::group([
    'middleware' => 'jwt.auth'
], function () {


    Route::get('/messages', [MessageController::class, 'allMessages']);

    Route::post('/messages', [MessageController::class, 'newMessage']);

    Route::get('/messages/{id}', [MessageController::class, 'messageByID']);

    Route::put('/messages/{id}', [MessageController::class, 'updateMessage']);

    Route::delete('/messages/{id}', [MessageController::class, 'deleteMessage']);

    Route::post('/message/party/{id}', [MessageController::class, "messagesByPartyID"]);
});

//games routes 

Route::group([
    'middleware' => 'jwt.auth'
], function () {

    Route::get('/games', [GameController::class, "All"]);

    Route::post('/games', [GameController::class, "gamesAdd"]);

    Route::post('/games/{id}', [GameController::class, "gameByID"]);

    Route::put('/games/{id}', [GameController::class, "updateGame"]);

    Route::delete('/games/{id}', [GameController::class, "deleteGame"]);
});

//parties routes 

Route::group([
    'middleware' => 'jwt.auth'
], function () {


    Route::get('/parties', [PartyController::class, "partiesAll"]);

    Route::post('/parties', [PartyController::class, "newParty"]);

    Route::get('/parties/{id}', [PartyController::class, "partyBygame_id"]);

    Route::put('/parties/{id}', [PartyController::class, "updateParty"]);

    Route::delete('/parties/{id}', [PartyController::class, "deleteParty"]);

    Route::post('/parties/game/{id}', [PartyController::class, "partiesBygame_id"]);
});
