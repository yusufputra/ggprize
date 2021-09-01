<?php

namespace App\Http\Controllers;

use App\Models\Refenced;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ReferencedController extends Controller
{
    public function useCode($code)
    {
        $payload = Auth::user();
        $user = User::where('uniqueCode', $code)->first();
        if ($user == null) {
            return response()->json(['message' => 'code not valid'], 404);
        }
        $used = Refenced::where(['from' => $user->id, 'to' => $payload->id])->first();
        if ($used != null) {
            return response()->json(['message'=>'code already used']);
        }
        $referal = Refenced::create([
            "from" => $user->id,
            "to" => $payload->id
        ]);
        return response()->json($referal);
    }
}
