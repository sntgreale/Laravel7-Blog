<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Comment;
use App\Like;
use App\User;
use Session;

class UserController extends Controller
{
    // GET ALL USERS
    public function index()
    {
        // Find all Users
        $users = User::orderBy('id' , 'desc') -> paginate(10);

        // Return all users to the view
        return view('users.index') -> withUsers($users);
    }

    // SHOW USER
    public function show($id)
    {
        // Find the user
        $user = User::where('id', '=', $id) -> first();

        // Find the posts by user
        $posts = Post::where('post_user_id', '=', $id) -> paginate(10);

        // Return data of the user
        return view('users.show') -> withUser($user) -> withPosts($posts);
    }

}
