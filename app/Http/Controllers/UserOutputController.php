<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserOutputController extends Controller
{
    public function all(){
        return User::all();
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
}
