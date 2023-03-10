<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function all()
    {
        // return DB::table('users')
        //     ->join('posts', 'posts.id_user', '=', 'users.id')
        //     // ->where('id_user', '=', $id)
        //     ->get();
        return PostResource::collection(Post::all());
    }

    public function posts_user()
    {
        return PostResource::collection(Post::all()->where('id_user', '=', Auth::user()->id));
    }

    public function posts_user_view($id)
    {
        return PostResource::collection(Post::all()->where('id_user', '=', $id));
    }

    public function delete_post($id)
    {
        $post = Post::find($id);
        $post->delete();
        return Post::all();
    }

    public function add_post(Request $request) {
        $id_user = Auth::user()->id;
        $post = new Post();
        $post->id_user = $id_user;
        $post->text = $request->text;
        $post->category = $request->category;
        $array_replace = ("watch?v=");
        $post->video_url = str_replace($array_replace, "embed/",$request->video_url);

        $images = $request->file('image');

        if ($images != null) {
            $fullPath = '';
            foreach($images as $image){
                $path = Storage::disk('local')->putFile('public/posts_img', $image) .',';
                $fullPath .= Storage::url($path);
            }
            $post->images = $fullPath;
        } else{
            $post->images = 'NULL';
        }
    
        $post->save();
    }

    public function edit_post(Request $request, $id)
    {
        $text = $request->input('text');
        $category = $request->input('category');

        DB::table('posts')->where('id',$id)->update([
            'text' => $text,
            'category' => $category
        ]);
    }
}
