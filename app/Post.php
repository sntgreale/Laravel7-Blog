<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Comment;
use App\RePost;
use App\Like;

class Post extends Model {
    //
    protected $table = "posts";

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reposts()
    {
        return $this->hasMany(RePost::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}