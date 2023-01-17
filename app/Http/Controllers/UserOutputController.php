<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserOutputController extends Controller
{
    public function random_five(){
        $id_user = Auth::user()->id;
        return DB::table('users')->inRandomOrder()->limit(5)->where('id', '!=', $id_user)->get();
    }

    public function all_users()
    {
        $id_user = Auth::user()->id;
        return DB::table('users')->where('id', '!=', $id_user)->get();
    }

    public function index($id){
        return User::find($id);
    }

    public function get($id){
        return User::find($id);
    }

    public function changeInfoUser(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');
        $password = $request->input('password');

        DB::table('users')->where('id',$id)->update([
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
    }

    public function dop_info(Request $request)
    {
        $id = $request->input('id');
        $age = $request->input('age');
        $city = $request->input('city');

        DB::table('users')->where('id',$id)->update([
            'age' => $age,
            'city' => $city
        ]);
    }
}
