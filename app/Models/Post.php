<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 'text', 'images', 'category'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
