<?php

namespace App\Http\Controllers;

use App\Http\Resources\FriendResource;
use App\Models\Friends;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class FriendsController extends Controller
{
    public function addFriend(Request $request)
    {
        $id_user = $request->input('id_user');
        $id_friend = $request->input('id_friend');

        DB::table('friends')->insert([
            'id_user' => $id_user,
            'id_friend' => $id_friend,
            'status' => 'false'
        ]);
        Friends::create([
            'id_user' => $id_friend,
            'id_friend' => $id_user,
            'status' => 'false'
        ]);
        Room::create([
            'name' => 'default',
            'id_user' => $id_user,
            'id_user_second' => $id_friend,
        ]);
    }

    public function index($id)
    {
        Auth::user()->id;
        // return DB::table('users')->where('friends.id_friend',$id)->get();

        // $arr = DB::table('users')
        //     ->join('friends', 'friends.id_user', '=', 'users.id')
        //     ->where('id_friend',$id || 'id_user',$id)
        //     ->get();
        $arr = FriendResource::collection(Friends::all()->where('id_user', $id));

            // DB::table('users')
            // ->join('friends', 'friends.id_friend', '=', 'users.id')
            // ->where('id_user', '=', $id)
            // ->get(),

        return $arr;
    }

    public function accept_friend($id)
    {
        // $friends = Friends::find($id);
        // $user = $friends->users;
        // $friends->update([
        //     'status' => 'true',
        // ]);

        // DB::table('friends')->where('id',$id)->update([
        //     'status' => 'true'
        // ]);
        DB::table('friends')->where('id_friend', $id)->where('id_user', Auth::user()->id)->update([
            'status' => 'true'
        ]);

        DB::table('friends')->where('id_friend', Auth::user()->id)->where('id_user', $id)->update([
            'status' => 'true'
        ]);
    }

    public function delete_friend($id)
    {
        // DB::table('friends')->where('id',$id)->delete();
        // dd($id);
        DB::table('friends')->where('id_friend', $id)->where('id_user', Auth::user()->id)->delete();
        DB::table('friends')->where('id_friend', Auth::user()->id)->where('id_user', $id)->delete();

        DB::table('rooms')->where('id_user', Auth::user()->id)->where('id_user_second', $id)->delete();
        DB::table('rooms')->where('id_user', $id)->where('id_user_second', Auth::user()->id)->delete();
    }

    public function block_friend($id)
    {
        // DB::table('friends')->where('id',$id)->update([
        //     'status' => 'block'
        // ]);
        // dd($id, Auth::user()->id);
        DB::table('friends')->where('id_friend', $id)->where('id_user', Auth::user()->id)->update([
            'status' => 'block'
        ]);

        DB::table('friends')->where('id_friend', Auth::user()->id)->where('id_user', $id)->update([
            'status' => 'invisible'
        ]);
    }
}
