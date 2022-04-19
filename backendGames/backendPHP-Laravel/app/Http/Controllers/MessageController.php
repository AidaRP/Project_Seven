<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{

    public function allMessages()
    {
        Log::info('allMessages()');

        try {

            $messages = Message::all();

            Log::info('Tasks done');

            return response()->json($messages, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    function newMessage(Request $request)
    {
        Log::info('newMessage()');
    
        try {
    
            $validator = Validator::make($request->all(), [
                'message' => 'required|string|max:255',
                'date' => 'required|string|max:15',
                'fromPlayer' => 'required|integer',
                'party_id' => 'required|integer',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed'], 400);
            }
    
            $message = Message::create([
                'message' => $request->message,
                'date' => $request->date,
                'fromPlayer' => $request->fromPlayer,
                'party_id' => $request->party_id,
            ]);
    
            Log::info('Tasks done');
            return response()->json($message, 200);
    
        } catch (\Exception $e) {
    
            Log::error($e->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
    
    public function messageByID($id)
    {
        Log::info('messageByID()');
    
        try {
    
            $message = Message::find($id);
            Log::info('Tasks done');
            return response()->json($message, 200);
    
        } catch (\Exception $e) {
    
            Log::error($e->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
    
    public function updateMessage(Request $request, $id)
    {
        Log::info('updateMessage()');
        try {
    
            $validator = Validator::make($request->all(), [
                'message' => 'required|string|max:255',
                'date' => 'required|string|max:15',
                'fromPlayer' => 'required|integer',
                'party_id' => 'required|integer',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed'], 400);
            }
    
            $message = Message::find($id);
            $message->message = $request->message;
            $message->date = $request->date;
            $message->fromPlayer = $request->fromPlayer;
            $message->party_id = $request->party_id;
            $message->save();
    
            Log::info('Tasks done');
            return response()->json($message, 200);
    
        } catch (\Exception $e) {
    
            Log::error($e->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
    
    public function deleteMessage($id)
    {
        Log::info('deleteMessage()');
    
        try {
    
            $message = Message::find($id);
            $message->delete();
            Log::info('Tasks done');
            return response()->json("el mensaje de $ ha sido eliminado", 200);
    
        } catch (\Exception $e) {
    
            Log::error($e->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
    
    public function messagesByPartyID($id)
    {
        Log::info('messagesByPartyID()');
    
        try {
    
            $messages = Message::where('party_id', $id)->get();
            Log::info('Tasks done');
            return response()->json($messages, 200);
    
        } catch (\Exception $e) {
    
            Log::error($e->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
}
