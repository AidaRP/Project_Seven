<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\ChatRoom;

class ChatRoomController extends Controller
{
    //All chats
    public function chatAll(){
        try {

            $chats = ChatRoom::all();
            return $chats;

        } catch (QueryException $error) {

            $codeError = $error->errorInfo[1];
            if($codeError){
                return "Error $codeError";
            }

        }
    }
//Chats by Id
public function chatById(Request $request){

    $id = $request->input('id');

    try {

        $chat = ChatRoom::all()
        ->where('id', "=", $id);
        return $chat;

    } catch (QueryException $error) {

        $codeError = $error->errorInfo[1];
        if($codeError){
            return "Error $codeError";
        }
    }
}
//Chat by Id for Game
public function chatByGameId(Request $request){

    $id = $request->input('id');

    try {
        $chat = ChatRoom::selectRaw('chats.name , games.title, users.name')
        ->join('games', 'chats.GameId', '=', 'games.id')
        ->where('chats.GameId', "=", $id)
        ->join('users', 'chats.OwnerId', '=', 'users.id')
        ->get();
        return $chat;

    } catch (QueryException $error) {

        $codeError = $error->errorInfo[1];
        if($codeError){
            return "Error $codeError";
        }
    }
}
//Create Chat
public function chatAdd (Request $request){

    $name = $request->input('name');
    $OwnerId = $request->input('OwnerId');
    $GameId = $request->input('GameId');

    try {

        return ChatRoom::create(
            [
                'name' => $name,
                'OwnerId' => $OwnerId,
                'GameId' => $GameId
            ]
        );

    } catch (QueryException $error) {

        $codeError = $error->errorInfo[1];
        if($codeError){
            return "Error $codeError";
        }
        
    }
}
//Update Chat
public function chatUpdate (Request $request){

    $id = $request->input('id');
    $name = $request->input('name');
    $OwnerId = $request->input('OwnerId');
    $GameId = $request->input('GameId');

    try {

        $chat = ChatRoom::where('id', '=', $id)
        ->update(
            [
                'name' => $name,
                'OwnerId' => $OwnerId,
                'GameId' => $GameId
            ]
        );
        return ChatRoom::all()
        ->where('id', "=", $id);

    } catch (QueryException $error) {

        $codeError = $error->errorInfo[1];
        if($codeError){
            return "Error $codeError";
        }

    }
}


}
