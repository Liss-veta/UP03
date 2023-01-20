<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function all(){
        $rooms = Room::all();
        $id = Auth::user()->id;
        $end_room = [];
        foreach($rooms as $room){
            if($room->id_user == $id){
                array_push($end_room, $room);
            }
            if($room->id_user_second == $id){
                array_push($end_room, $room);
            }
        }
        return RoomResource::collection($rooms);
        // if($rooms->count() === 0){
        //     $rooms2 = Room::all()->where('id_user_second', Auth::user()->id);
        //     return RoomResource::collection($rooms2);
        // } else {
        //     return RoomResource::collection($rooms);
        // }
    }
        
}
