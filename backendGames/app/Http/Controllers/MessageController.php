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
    //Messages by ID
    public function messageByID(Request $request){

        $id = $request->input('id');

        try {

            $message = Message::all()
            ->where('id', "=", $id);
            return $message;

        } catch (QueryException $error) {

            $codeError = $error->errorInfo[1];
            if($codeError){
                return "Error $codeError";
            }
        }
    }
    //Messages by Party Id
    public function messageByPartyId(Request $request){

        $id = $request->input('id');

        try {
            $message = Message::selectRaw('messages.message, users.username, parties.name')
            ->join('parties', 'parties.id', '=', 'messages.PartyId')
            ->where('messages.PartyId', "=", $id)
            ->join('users', 'users.id', '=', 'messages.FromPlayer')
            ->get();
            return $message;

        } catch (QueryException $error) {

            $codeError = $error->errorInfo[1];
            if($codeError){
                return "Error $codeError";
            }
        }
    }
    //

}
