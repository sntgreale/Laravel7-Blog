<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Notifications\Notifiable; // Slack Noti

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Comment;
use App\RePost;
use App\Like;
use App\Notifications\SlackNoti;

use Session;

class PostController extends Controller
{
    // GET ALL POSTS
    public function index()
    {
        // Find all Posts
        $posts = Post::join('users', 'posts.post_user_id', '=', 'users.id') -> orderBy('posts.post_id' , 'desc') -> paginate(10);

        // Return all posts to the view
        return view('posts.index') -> withPosts($posts);
    }

    // CREATE POST
    public function create()
    {
        if ( Auth::user() -> is_admin == 0)
        {
            // Return a view for create post
            return view('posts.create');
        }

        return redirect('posts');

    }

    // SAVE POST
    public function store(Request $request)
    {
        // Validate the data
        $validatedData = $request -> validate([
            'post_title' => 'required|max:50',
            'post_body' => 'required',
        ]);

        // Save in the database
        $post = new Post;
        $post -> post_title = $request -> post_title;
        $post -> post_body = $request -> post_body;
        $post -> post_user_id = Auth::user() -> id;
        $post -> post_created_at = now();

        $post -> save();

        // Show message of the successfuly save 
        Session::flash('success', 'The blog post was successfully save!');

        // Redirect to another page
        return redirect() -> route('users.show', Auth::user() -> id);
    }

    // SHOW POST
    public function show($id)
    {
        // Find the post
        $post = Post::where('post_id', '=', $id) -> join('users', 'posts.post_user_id', '=', 'users.id') -> first();

        $comments = Comment::where('comment_post_id', '=', $id) -> join('users', 'comments.comment_user_id', '=', 'users.id') -> orderBy('comment_id', 'desc') -> get();

        $repost = RePost::where([
            ['repost_user_id', '=', Auth::user() -> id],
            ['repost_post_id', '=', $id]
        ]) -> join('users', 'reposts.repost_user_id', '=', 'users.id') -> get();

        $like = Like::where([
            ['like_user_id', '=', Auth::user() -> id],
            ['like_post_id', '=', $id]
        ]) -> join('users', 'likes.like_user_id', '=', 'users.id')  -> get();

        // Return data of the post
        return view('posts.show') -> withPost($post) -> withComments($comments) -> withRepost($repost) -> withLike($like);
    }

    // EDIT POST
    public function edit($id)
    {

        // Find the post in the DB
        $post = Post::where('post_id', '=', $id) -> join('users', 'posts.post_user_id', '=', 'users.id') -> first();
        
        if ((Auth::user() -> id == $post -> post_user_id) or (Auth::user() -> is_admin == 1))
        {
            // Return the view - Pass the value of the field
            return view('posts.edit') -> withPost($post);
        }

        return redirect('home');

    }

    // UPDATE POST
    public function update(Request $request, $id)
    {
        // Validate the data        
        $validatedData = $request -> validate([
            'post_title' => 'required|max:50',
            'post_body' => 'required',
        ]);

        // Update the data to the database
        $post = Post::where('post_id', '=', $id) -> update([
            'post_title' => $request ->input('post_title'),
            'post_body' => $request -> input('post_body')
        ]);

        // Set flash data with success message
        Session::flash('success', 'The blog post was successfully save!');

        // Find post updated
        $post = Post::where('post_id', '=', $id) -> join('users', 'posts.post_user_id', '=', 'users.id') -> first();

        // Redirect with flash data to posts.show
        return redirect() -> route('posts.show', $post -> post_id);
    }

    // DESTROY POST
    public function destroy($id)
    {

        // Delete post
        Post::where('post_id', '=', $id) -> delete();

        // Send message to the view
        Session::flash('success', 'The post was successfully deleted.');

        return redirect() -> route('posts.index');
    }
}
