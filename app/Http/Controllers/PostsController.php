<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function all()
    {
        return DB::table('users')
            ->join('posts', 'posts.id_user', '=', 'users.id')
            // ->where('id_user', '=', $id)
            ->get();
    }

    public function posts_user()
    {
        $id = Auth::user()->id;
        return DB::table('users')
            ->join('posts', 'posts.id_user', '=', 'users.id')
            ->where('id_user', '=', $id)
            ->get();
    }

    public function add_post(Request $request) {
        $id_user = Auth::user()->id;
        $post = new Post();
        $post->id_user = $id_user;
        $post->text = $request->text;
        $post->category = $request->category;

        $images = $request->file('image');

        $fullPath = '';
        foreach($images as $image){
            $path = Storage::disk('local')->putFile('public/posts_img', $image) .',';
            $fullPath .= Storage::url($path);
        }
        $post->images = $fullPath;
    
        $post->save();
    }
}
