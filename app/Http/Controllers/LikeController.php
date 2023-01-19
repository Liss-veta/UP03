<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function all(){
        return Like::all();
    }
    public function store(Request $request){
        $like = Like::where('id_post', $request->input('id_post'))->where('id_user', Auth::user()->id);
        
        if($like->exists()){
            $like->delete();
        } else {
            Like::create([
                'id_post' => $request->input('id_post'),
                'id_user' => Auth::user()->id,
            ]);
        }
        return response()->json([
            'data' => Like::all()->where('id_post', $request->input('id_post')),
            'count' => Like::all()->where('id_post', $request->input('id_post'))->count(),
        ]);
    }
    public function destroy($id){
        $like = Like::find($id);
        $like->delete();
    }
}
