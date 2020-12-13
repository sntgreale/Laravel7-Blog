<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Follow;
use App\Comment;
use App\RePost;
use App\Like;

use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // Obtain the user active ID
        $idActive = Auth::id(); // User id currently active

        // I get the followings of the active user
        $follows = Follow::where('userFollower_id', '=', $idActive) -> get();

        $ids = array();

        // I make an array with the ids of the following
        foreach($follows as $follow)
        {
            $ids[] = $follow -> userFollowed_id;
        }

        // Obtain the posts of the following
        $posts = Post::whereIn('post_user_id', $ids) -> join('users', 'posts.post_user_id', '=', 'users.id') -> paginate(5);

        // Obtain the latest (5) reposts of the following
        $reposts = RePost::whereIn('repost_user_id', $ids) -> join('users', 'reposts.repost_user_id', '=', 'users.id') -> join('posts', 'reposts.repost_post_id', '=', 'posts.post_id') -> get() -> take(7);

        // Obtain the latest (5) likes of the following
        $likes = Like::whereIn('like_user_id', $ids) -> join('users', 'likes.like_user_id', '=', 'users.id') -> join('posts', 'likes.like_post_id', '=', 'posts.post_id') -> get() -> take(7);
        
        // Return data of the post
        return view('posts.feed') -> withPosts($posts) -> withReposts($reposts) -> withLikes($likes);

    }
}
