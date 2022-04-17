<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use App\Models\Member;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    //List all Members
    public function membersAll(){
        try {

            $members = Member::all();
            return $members;

        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];
            if($codigoError){
                return "Error $codigoError";
            }

        }
}
