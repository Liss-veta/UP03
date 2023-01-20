<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Resources\RoomResource;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSend;
use App\Http\Resources\MessageResource;

class MessageController extends Controller
{
    public function all($id){
        return Message::all()->where('id_room', $id);
    }
    public function getMessages($id){
        return new RoomResource(Room::find($id));
    }
    public function store(Request $request){
        $user = Auth::user();
        $message = Message::create([
            'message' => $request->input('message'),
            'id_room' => $request->input('id_room'),
            'id_user' => $user->id,
        ]);

        broadcast( new MessageSend($user,$message))->toOthers();
        
        return response()->json([
            'message' => 'Сообщение отправлено',
            'data' => new MessageResource($message),
        ]);
    }
    public function destroy($id){
        $message =Message::find($id);
        $message->delete();
        return response()->json([
            'message' => 'Сообщение удалено'
        ]);
    }
}
