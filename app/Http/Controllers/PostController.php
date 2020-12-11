<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Comment;
use App\Like;
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
        // Return a view for create post
        return view('posts.create');
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

        $post -> save();

        // Show message of the successfuly save 
        Session::flash('success', 'The blog post was successfully save!');

        // Redirect to another page
        return redirect() -> route('posts.show', $post -> post_id);
    }

    // SHOW POST
    public function show($id)
    {
        // Find the post
        $post = Post::where('post_id', '=', $id) -> join('users', 'posts.post_user_id', '=', 'users.id') -> first();

        $comments = Comment::where('comment_post_id', '=', $id) -> join('users', 'comments.comment_user_id', '=', 'users.id') -> get();

        //Comment::where('post_id', '=', $id) -> join('users', 'comments.user_id', '=', 'users.id');

        // Return data of the post
        return view('posts.show') -> withPost($post) -> withComments($comments);
    }

    // EDIT POST
    public function edit($id)
    {
        // Find the post in the DB
        $post = Post::where('post_id', '=', $id) -> join('users', 'posts.post_user_id', '=', 'users.id') -> first();
        // Return the view - Pass the value of the field
        return view('posts.edit') -> withPost($post);
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
        // Delete likes of the post
        Like::where('like_post_id', '=', $id) -> delete();

        // Delete comments of the post
        Comment::where('comment_post_id', '=', $id) -> delete();

        // Delete post
        Post::where('post_id', '=', $id) -> delete();

        // Send message to the view
        Session::flash('success', 'The post was successfully deleted.');

        return redirect() -> route('posts.index');
    }
}
