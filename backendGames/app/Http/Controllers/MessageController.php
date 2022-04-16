<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use App\Models\Message;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    //All messages
    public function messagesAll(){
        try {

            $messages = Message::all();
            return $messages;

        } catch (QueryException $error) {

            $codeError = $error->errorInfo[1];
            if($codeError){
                return "Error $codeError";
            }

        }
    }
}
