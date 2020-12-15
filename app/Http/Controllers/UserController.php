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
use App\Follow;

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

        if ($user -> is_admin == 1)
        {
            return redirect() -> route('users.index');
        }

        $follow = Follow::where([
            ['userFollower_id', '=', Auth::user() -> id],
            ['userFollowed_id', '=', $id]
        ]) -> get();

        // Find the posts by user
        $posts = Post::where('post_user_id', '=', $id) -> orderBy('post_id', 'desc') -> paginate(10);

        // Return data of the user
        return view('users.show') -> withUser($user) -> withPosts($posts) -> withFollow($follow);
    }

    // DELETE USER
    public function destroy($id)
    {
        // Find user on db
        $user = User::where('id', '=', $id) -> first();

        if ( Auth::user() -> is_admin == 0 )
        {
            return redirect() -> route('home');
        }

        // Delete User
        User::where('id', '=', $id) -> delete();

        // Send message to the view
        Session::flash('success', 'The user was successfully deleted.');

        return redirect() -> route('users.index');
    }

}
