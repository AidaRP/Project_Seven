<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\User;

class PlayerController extends Controller
{
    //List All Players
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

    //List PLayer By Id
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

    //Update Player
    public function updatePlayer(Request $request)
    {

        $id = $request->input('id');
        $name = $request->input('name');
        $nick = $request->input('nick');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = $request->input('role');

        try {
            $player = User::where('id', "=", $id)->update(
                [
                    'name' => $name,
                    'nick' => $nick,
                    'email' => $email,
                    'password' => $password,
                    'role' => $role,
                ]
            );
            return User::all()->where('id', "=", $id);
        } catch (QueryException $error) {
            $codeError = $error->errorInfo[1];
            if ($codeError) {
                return "Error $codeError";
            }
        }
    }
    //Delete Player by Id
    public function deletePlayerById(Request $request){
        $id = $request->input('id');

        try {
            $arrayPlayer = User::all()->where('id', "=", $id);

            $player = User::where('id', '=', $id);

            if(count($arrayPlayer) == 0){
                return response()->json([
                    "data"=> $arrayPlayer,
                    "message"=> "Player not found"
                ]);
            }else{
                $player->delete();
                return response()->json([
                    "data"=> $arrayPlayer,
                    "message"=> "Player has been deleted succesfully"
                ]);
            }
        } catch (QueryException $error) {
            $codeError = $error->errorInfo[1];
            if($codeError){
                return "Error $codeError";
            }
        }
    }

}
