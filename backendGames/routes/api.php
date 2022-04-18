<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MemberController;

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
    //Members
    Route::get('members', [MemberController::class, "membersAll"]);
    Route::post('memberByID', [MemberController::class, "memberByID"]);
    Route::post('memberByPartyID', [MemberController::class, "memberByPartyID"]);
    Route::post('memberByPlayerID', [MemberController::class, "memberByPlayerID"]);
    Route::post('newMember', [MemberController::class, "memberAdd"]);
    Route::put('updateMember', [MemberController::class, "memberUpdate"]);
    Route::delete('deleteMember', [MemberController::class, "memberDelete"]);
    //Messages
    Route::get('messages', [MessageController::class, "messagesAll"]);
    Route::post('messageById', [MessageController::class, "messageById"]);
    Route::post('messageByPartyId', [MessageController::class, "messageByPartyId"]);
    Route::post('newMessage', [MessageController::class, "messageAdd"]);
    Route::put('updateMessage', [MessageController::class, "messageUpdate"]);
    Route::delete('deleteMessage', [MessageController::class, "messageDelete"]);
    //Games
    Route::get('games', [GameController::class, "gamesAll"]);
    Route::get('gameById', [GameController::class, "gameByID"]);
    Route::post('gameAdd', [GameController::class, "gameAdd"]);
    Route::put('gameUpdate', [GameController::class, "gameUpdate"]);
    //Players/Users
    Route::get('playersAll', [PlayerController::class, 'playersAll']);
    Route::post('playerByID', [PlayerController::class, "playerByID"]);
    Route::put('playerUpdate', [PlayerController::class, "playerUpdate"]);
    Route::delete('playerDelete', [PlayerController::class, "playerDelete"]);
    Route::delete('gameDeleteById', [GameController::class, "gameDeleteById"]);
    Route::get('parties', [PartyController::class, "partiesAll"]);
    //Parties
    Route::post('partyByID', [PartyController::class, "partyByID"]);
    Route::post('partyByIDGame', [PartyController::class, "partyByGameID"]);
    Route::post('newParty', [PartyController::class, "partyAdd"]);
    Route::put('updateParty', [PartyController::class, "partyUpdate"]);
    Route::delete('deleteParty', [PartyController::class, "partyDelete"]);
});
