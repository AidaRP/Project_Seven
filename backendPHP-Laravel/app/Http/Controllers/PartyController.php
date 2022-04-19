<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PartyController extends Controller
{

    public function partiesAll()
{
    Log::info('partiesAll()');

    try {

        $parties = Party::all();
        Log::info('Tasks done');
        return response()->json($parties, 200);

    } catch (\Exception $e) {
        Log::error($e->getMessage());

        return response()->json(['message' => 'Something went wrong'], 500);
    }
}

public function newParty(Request $request)
{
    Log::info('newParty()');

    try {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'user_id' => 'required|max:255',
            'Game_id' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed'], 400);
        }

        $party = Party::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'Game_id' => $request->Game_id,
        ]);

        Log::info('Tasks done');
        return response()->json($party, 200);

    } catch (\Exception $e) {

        Log::error($e->getMessage());
        return response()->json(['message' => 'Something went wrong'], 500);
    }
}

public function partyBygame_id($id)
{
    Log::info('getParty()');

    try {

        $party = Party::find($id);

        Log::info('Tasks done');

        return response()->json($party, 200);

    } catch (\Exception $e) {

        Log::error($e->getMessage());

        return response()->json(['message' => 'Something went wrong'], 500);
    }
}

public function updateParty(Request $request, $id)
{
    Log::info('updateParty()');

            try {

                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'user_id' => 'required|max:255',
                    'Game_id' => 'required|max:255',
                ]);

                if ($validator->fails()) {
                    return response()->json(['message' => 'Validation failed'], 400);
                }

                $party = Party::find($id);

                $party->name = $request->name;
                $party->user_id = $request->user_id;
                $party->Game_id = $request->Game_id;

                $party->save();

                Log::info('Tasks done');

                return response()->json($party, 200);

            } catch (\Exception $e) {

                Log::error($e->getMessage());

                return response()->json(['message' => 'Something went wrong'], 500);
            }
}

public function deleteParty($id)
{
    Log::info('deleteParty()');

    try {

        $party = Party::find($id);

        $party->delete();

        Log::info('Tasks done');

        return response()->json(['message' => 'Party deleted'], 200);

    } catch (\Exception $e) {

        Log::error($e->getMessage());

        return response()->json(['message' => 'Something went wrong'], 500);
    }
}

public function partiesBygame_id($id)
{
    Log::info('partiesByGameID()');

    try {

        $parties = Party::where('Game_id', $id)->get();

        Log::info('Tasks done');

        return response()->json($parties, 200);

    } catch (\Exception $e) {

        Log::error($e->getMessage());

        return response()->json(['message' => 'Something went wrong'], 500);
    }
}
    
}
