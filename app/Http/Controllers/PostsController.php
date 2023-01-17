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
        $image = $request->file('file');
        // dd($image->getClientOriginalName());
        if ($image) {
            $path = Storage::putFile('public/posts_img', $image);
            $post->images = Storage::url($path);
        }
        $post->save();
    }
    // public function add_post(Request $request)
    // {
    //     //$fileName = $request->file('images')->getClientOriginalName();

    //     $fileName = $request->file('file')->store('/posts_img');
    //     $data = $request->all();
    //     $image = $request->file('file');
    //     if ($image) {
    //         $path = Storage::putFile('public', $image);
    //         $data->image = Storage::url($path);
    //     }
    //     $data['images'] = $fileName;
    //     $data['id_user'] = Auth::user()->id;

    //     //$request->file->move(public_path('posts_img'), $fileName);

    //     Post::query()->create($data);
    // }
}
