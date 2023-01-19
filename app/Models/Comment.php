<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 'id_post', 'comm'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
