<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\User;

class PlayerController extends Controller
{
    //List All Players
    public function playersAll(){
        try {

            $players = User::all();
            return $players;

        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];
            if($codigoError){
                return "Error $codigoError";
            }

        }
    }

    //Player/User by Id
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function playerByID(Request $request){
        
        $id = $request->input('id');

        try {
            $player = User::all()
            ->where('id', "=", $id);
            return $player;

        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];
            if($codigoError){
                return "Error $codigoError";
            }
        }
    }

    //Update User/Player
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function playerUpdate (Request $request){

        $id = $request->input('id');
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = $request->input('role');

        try {

            $player = User::where('id', '=', $id)
            ->update(
                [
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'role' => $role,
                ]
            );
            return User::all()
            ->where('id', "=", $id);

        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];
            if($codigoError){
                return "Error $codigoError";
            }

        }
    }

    //Delete user by Id
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function playerDelete(Request $request){

        $id = $request->input('id');

        try {
            $arrayPlayer = User::all()
            ->where('id', '=', $id);

            $player = User::where('id', '=', $id);
            
            if (count($arrayPlayer) == 0) {
                return response()->json([
                    "data" => $arrayPlayer,
                    "message" => "No se ha encontrado el player"
                ]);
            }else{
                $player->delete();
                return response()->json([
                    "data" => $arrayPlayer,
                    "message" => "Player borrado correctamente"
                ]);
            }

        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];
            if($codigoError){
                return "Error $codigoError";
            }

        }
    }
}
