<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostsController extends Controller
{
    public function all()
    {
        $id = Auth::user()->id;
        return DB::table('users')
            ->join('posts', 'posts.id_user', '=', 'users.id')
            ->where('id_user', '=', $id)
            ->get();
    }

    public function add_post(Request $request)
    {
        //$fileName = $request->file('images')->getClientOriginalName();
        $fileName = $request->file('file')->store('/posts_img');
        $data = $request->all();
        $data['images'] = $fileName;
        $data['id_user'] = Auth::user()->id;

        //$request->file->move(public_path('posts_img'), $fileName);

        Post::query()->create($data);
    }
}
