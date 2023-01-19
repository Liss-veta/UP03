<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function output_comm(Request $request)
    {
        return DB::table('comments')
            // ->join('posts', 'posts.id', '=', 'id_post')
            ->join('users', 'users.id', '=', 'id_user')
            ->select('users.name', 'users.surname', 'users.avatar', 'comments.*')
            // ->where('id_user', '=', 'users.id')
            ->get();
    }

    public function add_comm(Request $request)
    {
        Comment::create([
            'id_user' => Auth::user()->id,
            'id_post' => $request->input('id_post'),
            'comm' => $request->input('comm'),
        ]);
    }
}
