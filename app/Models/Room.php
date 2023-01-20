<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function users(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function usersSecond(){
        return $this->belongsTo(User::class, 'id_user_second');
    }
    public function messages(){
        return $this->hasMany(Message::class, 'id_room', 'id');
    }
}
