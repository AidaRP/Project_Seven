<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\User;

class PlayerController extends Controller
{
    //List All Users
    public function playersAll()
    {

        try {
            $players = User::all();
            return $players;
        } catch (QueryException $error) {

            $codeError = $error->errorInfo[1];
            if ($codeError) {
                return "Error $codeError";
            }
        }
    }

    //List User By Id
    public function playerById(Request $request)
    {

        $id = $request->input('id');
        try {
            $player = User::all()->where('id', "=", $id);
            return $player;
        } catch (QueryException $error) {
            $codeError = $error->errorInfo[1];
            if ($codeError) {
                return "Error $codeError";
            }
        }
    }

    




}
