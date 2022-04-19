<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{

    public function All(){
        Log::info('gamesAll()');
            
        try {
            $games = Game::all();
            Log::info('Tasks done');
            return response()->json($games, 200);
    
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
    
    public function gamesAdd(Request $request)
    {
        Log::info('gamesAdd()');
        try {
    
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'thumbnail_url' => 'required|string|max:255',
                'url' => 'required|string|max:255',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed'], 400);
            }
    
            $game = Game::create([
                'title' => $request->title,
                'thumbnail_url' => $request->thumbnail_url,
                'url' => $request->url,
            ]);
            Log::info('Tasks done');
            return response()->json($game, 201);
    
        } catch (\Exception $e) {
    
            Log::error($e->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
    
    public function gameByID($id)
    {
        Log::info('gameByID()');
        try {
    
            $game = Game::find($id);
            if (!$game) {
                return response()->json(['message' => 'Game not found'], 404);
            }
    
            Log::info('Tasks done');
            return response()->json($game, 200);
    
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
    
    public function updateGame($id, Request $request)
    {
        Log::info('updateGame()');
        $title = $request->input('title');
        $thumbnail_url = $request->input('thumbnail_url');
        $url = $request->input('url');
    
        try {
    
            $game = Game::find($id);
    
            if (!$game) {
                return response()->json(['message' => 'Game not found'], 404);
            }
    
            $game->title = $title;
            $game->thumbnail_url = $thumbnail_url;
            $game->url = $url;
            $game->save();
    
            Log::info('Tasks done');
            return response()->json($game, 200);
    
        } catch (\Exception $e) {
    
            Log::error($e->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
    
    public function deleteGame($id)
    {
        Log::info('deleteGame()');
    
        try {
            $game = Game::find($id);
            if (!$game) {
                return response()->json(['message' => 'Game not found'], 404);
            }
    
            $game->delete();
            Log::info('Tasks done');
            return response()->json(['message' => 'Game deleted'], 200);
    
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
}
