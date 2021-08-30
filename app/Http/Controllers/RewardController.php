<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class RewardController extends Controller
{
    public function addDiamond(Request $request)
    {
        $payload = Auth::user();
        $validator = Validator::make($request->all(), [
            'gameid' => 'string',
            'point' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $reward = Reward::create([
            'author' => $payload->id,
            'gameid' => $request->gameid,
            'point' => $request->point
        ]);
        return response()->json($reward, 201);
    }
    public function DecreaseDiamond(Request $request)
    {
        $payload = Auth::user();
        $validator = Validator::make($request->all(), [
            'gameid' => 'string',
            'point' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        //cek point harus dibawah 0
        //cek diamond apakah cukup untuk ditambahkan
        $reward = Reward::create([
            'author' => $payload->id,
            'gameid' => $request->gameid,
            'point' => $request->point
        ]);
        return response()->json($reward, 201);
    }

    public function getTotal()
    {
        // ->groupBy('author')
        $payload = Auth::user();
        $reward = Reward::where('author', $payload->id)->get()->sum('point');
        return response()->json(['point' => $reward], 201);
    }
}
