<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;
use App\Comment;
use App\RePost;
use App\Like;
use App\Follow;


class ApiController extends Controller
{
    //
    public function users()
    {
        // Select all users of the DB.
        $users = User::select('name', 'email', 'created_at') -> where('is_admin', '=', 0) -> get();

        return ($users);
    }

    public function posts()
    {
        // Select all posts on the DB.
        $posts = Post::select('post_title', 'post_body', 'post_created_at') -> get(); 

        return($posts);
    }

    public function statistics()
    {
        $users = User::count();

        $posts = Post::count();

        $comments = Comment::count();

        $reposts = RePost::count();

        $likes = Like::count();

        $relationships = Follow::count();

        return (['Users: ' => $users, 'Posts: ' => $posts, 'Comments: ' => $comments ,'Reposts: ' => $reposts, 'Likes: ' => $likes, 'Relationships: ' => $relationships]);
    }

}
