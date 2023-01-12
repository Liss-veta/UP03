<?php

namespace App\Http\Controllers;

use App\Models\Friends;
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
    }

    public function index($id)
    {
        Auth::user()->id;
        // return DB::table('users')->where('friends.id_friend',$id)->get();

        $arr = [
            DB::table('users')
            ->join('friends', 'friends.id_user', '=', 'users.id')
            ->where('id_friend', '=', $id)
            ->get(),

            DB::table('users')
            ->join('friends', 'friends.id_friend', '=', 'users.id')
            ->where('id_user', '=', $id)
            ->get(),
        ];

        return $arr;
    }
}
