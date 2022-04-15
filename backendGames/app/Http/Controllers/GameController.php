<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\Game;

class GameController extends Controller
{
    //All Games
    public function gamesAll(){
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
    public function gameById (Request $request){
        $id = $request->input('id');

        try {
            $game = Game::all()->where('id', "=", $id);
            return $game;
        } catch (QueryException $error) {
            $codeError = $error->errorInfo[1];
            if($codeError){
                return "Error $codeError";
            
            }
        }
    }

}


