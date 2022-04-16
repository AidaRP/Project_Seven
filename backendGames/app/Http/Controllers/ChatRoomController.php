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






}
