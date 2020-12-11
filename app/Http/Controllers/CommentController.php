<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Comment;
use Session;

class CommentController extends Controller
{
    // GET ALL COMMENTS
    public function index()
    {
        $comments = Comment::join('users', 'comments.comment_user_id', '=', 'users.id') -> join('posts', 'comments.comment_post_id', '=', 'posts.id') -> orderBy('comments.comment_id', 'desc') -> paginate(10);
    
        return view('comments.index') -> withComments($comments);
    }
}
