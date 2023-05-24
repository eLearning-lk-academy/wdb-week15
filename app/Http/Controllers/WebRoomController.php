<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class WebRoomController extends Controller
{
    public function index(Request $request)
    {
        // $rooms = Room::where('type', $request->booking_roomtype)
        //     ->where('occupancy','>=',$request->booking_adults)
        //     ->where('status','available')
        //     ->get();

        $rooms = new Room;
        if($request->booking_roomtype){
            $rooms =$rooms->where('type', $request->booking_roomtype);
        }
        if($request->booking_adults){
            $rooms =$rooms->where('occupancy','>=',$request->booking_adults);
        }
        $rooms =$rooms->get();
        
        return view('web.rooms.list', compact('rooms'));
        
    }
    public function show($slug)
    {
        $room = Room::where('slug',$slug)->first();
        // dd($room);
        return view('web.rooms.show', compact('room'));
    }
}