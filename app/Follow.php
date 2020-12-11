<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Follow extends Model {
    //
    protected $table = "follows";
    public $timestamps = false;

    public function userFollower()
    {
        return $this -> belongsTo(User::class);
    }

    public function userFollowed()
    {
        return $this -> belongsTo(User::class);
    }
}