<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
    Route::get('members', [MemberController::class, "membersAll"]);
    Route::post('memberByID', [MemberController::class, "memberByID"]);
    Route::post('memberByPartyID', [MemberController::class, "memberByPartyID"]);
    Route::post('memberByPlayerID', [MemberController::class, "memberByPlayerID"]);
    Route::post('newMember', [MemberController::class, "memberAdd"]);
    Route::put('updateMember', [MemberController::class, "memberUpdate"]);
    Route::delete('deleteMember', [MemberController::class, "memberDelete"]);
    
    Route::get('messages', [MessageController::class, "messagesAll"]);
    Route::post('messageById', [MessageController::class, "messageById"]);
    Route::post('messageByPartyId', [MessageController::class, "messageByPartyId"]);
    Route::post('newMessage', [MessageController::class, "messageAdd"]);
    Route::put('updateMessage', [MessageController::class, "messageUpdate"]);
    Route::delete('deleteMessage', [MessageController::class, "messageDelete"]);
});
