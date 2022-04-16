<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\Message;

class MessageController extends Controller
{
    //All messages
    public function messagesAll()
    {
        try {

            $messages = Message::all();
            return $messages;
        } catch (QueryException $error) {

            $codeError = $error->errorInfo[1];
            if ($codeError) {
                return "Error $codeError";
            }
        }
    }
    //Messages by ID
    public function messageByID(Request $request)
    {

        $id = $request->input('id');

        try {

            $message = Message::all()
                ->where('id', "=", $id);
            return $message;
        } catch (QueryException $error) {

            $codeError = $error->errorInfo[1];
            if ($codeError) {
                return "Error $codeError";
            }
        }
    }
    //Messages by Party Id
    public function messageByPartyId(Request $request)
    {

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
            if ($codeError) {
                return "Error $codeError";
            }
        }
    }
    //Create a new message
    public function messageAdd(Request $request)
    {

        $message = $request->input('message');
        $date = $request->input('date');
        $FromPlayer = $request->input('FromPlayer');
        $PartyId = $request->input('PartyId');

        try {

            return Message::create(
                [
                    'message' => $message,
                    'date' => $date,
                    'FromPlayer' => $FromPlayer,
                    'PartyId' => $PartyId
                ]
            );
        } catch (QueryException $error) {

            $codeError = $error->errorInfo[1];
            if ($codeError) {
                return "Error $codeError";
            }
        }
    }
    //update message
    public function messageUpdate(Request $request)
    {

        $id = $request->input('id');
        $message = $request->input('message');
        $date = $request->input('date');
        $FromPlayer = $request->input('FromPlayer');
        $PartyId = $request->input('PartyId');

        try {

            $message = Message::where('id', '=', $id)
                ->update(
                    [
                        'message' => $message,
                        'date' => $date,
                        'FromPlayer' => $FromPlayer,
                        'PartyId' => $PartyId
                    ]
                );
            return Message::all()
                ->where('id', "=", $id);
        } catch (QueryException $error) {

            $codeError = $error->errorInfo[1];
            if ($codeError) {
                return "Error $codeError";
            }
        }
    }
    //Delete message by Id
    public function messageDelete(Request $request)
    {

        $id = $request->input('id');

        try {
            $arrayMessage = Message::all()
                ->where('id', '=', $id);

            $message = Message::where('id', '=', $id);

            if (count($arrayMessage) == 0) {
                return response()->json([
                    "data" => $arrayMessage,
                    "message" => "No se ha encontrado el message"
                ]);
            } else {
                $message->delete();
                return response()->json([
                    "data" => $arrayMessage,
                    "message" => "Message borrado correctamente"
                ]);
            }
        } catch (QueryException $error) {

            $codeError = $error->errorInfo[1];
            if ($codeError) {
                return "Error $codeError";
            }
        }
    }
}
