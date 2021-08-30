<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class EventController extends Controller
{
    //
    public function addEvent(Request $request)
    {
        $payload = Auth::user();
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg|max:5000',
            'title' => 'required|string',
            'content' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        }
        $image = $request->file('image');
        $event = Event::create([
            'author' => $payload->id,
            'image' => $image->getClientOriginalName(),
            'title' => $request->title,
            'content' => $request->content
        ]);
        return response()->json($event, 201);
    }
    public function getAllEvent()
    {
        return response()->json(Event::get(), 200);
    }
    public function detailEvent($id)
    {
        return response()->json(Event::where('id', $id)->get(), 200);
    }
}
