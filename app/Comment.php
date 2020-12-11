<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Post;
use App\User;

class Comment extends Model {
    //
    protected $table = "comments";
    public $timestamps = false;

    public function post()
    {
        return $this -> belongsTo(Post::class);
    }

    public function user()
    {
        return $this -> belongsTo(User::class);
    }
}