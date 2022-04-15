<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\Game;

class GameController extends Controller
{
    //All Games
    public function gamesAll()
    {
        try {
            $games = Game::all();
            return $games;
        } catch (QueryException $error) {
            $codeError = $error->errorInfo[1];
            if ($codeError) {
                return "Error $codeError";
            }
        }
    }

    //Game by ID
    public function gameById(Request $request)
    {
        $id = $request->input('id');

        try {
            $game = Game::all()->where('id', "=", $id);
            return $game;
        } catch (QueryException $error) {
            $codeError = $error->errorInfo[1];
            if ($codeError) {
                return "Error $codeError";
            }
        }
    }

    //Create Game
    public function gameAdd(Request $request)
    {
        $title = $request->input('title');
        $splashArtUrl = $request->input('splashArtUrl');
        $url = $request->input('url');
        try {
            return Game::create([
                'title' => $title,
                'splashArtUrl' => $splashArtUrl,
                'url' => $url
            ]);
        } catch (QueryException $error) {
            $codeError = $error->errorInfo[1];
            if ($codeError) {
                return "Error $codeError";
            }
        }
    }
    //Game update 
    public function gameUpdate(Request $request)
    {
        $id = $request->input('id');
        $title = $request->input('title');
        $splashArtUrl = $request->input('splashArtUrl');
        $url = $request->input('url');
        try {
            $game = Game::where('id', "=", $id)->update([
                $title = $title,
                $splashArtUrl = $splashArtUrl,
                $url = $url
            ]);
        } catch (QueryException $error) {
            $codeError = $error->errorInfo[1];
            if ($codeError) {
                return "Error $codeError";
            }
        }
    }
    //Game delete by Id
    public function gameDeleteById(Request $request)
    {
        $id = $request->input('id');
        try {
            $arrayGame = Game::all()->where('id', "=", $id);
            
            $game = Game::where('id', '=', $id);

            if (count($arrayGame) == 0) {
                return response()->json([
                    "data" => $arrayGame,
                    "message" => "The game does not exist"
                ]);
            } else {
                $game->delete();
                return response()->json([
                    "data" => $arrayGame,
                    "message" => "The game has been deleted successfully 👾"
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
