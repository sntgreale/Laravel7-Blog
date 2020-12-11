<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Comment;
use Session;

class PostController extends Controller
{
    // GET ALL POSTS
    public function index()
    {
        // Find all Posts
        $posts = Post::join('users', 'posts.user_id', '=', 'users.id') -> orderBy('posts.id' , 'desc') -> paginate(10);

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
            'title' => 'required|max:50',
            'body' => 'required',
        ]);

        // Save in the database
        $post = new Post;
        $post -> title = $request -> title;
        $post -> body = $request -> body;

        $post -> save();

        // Show message of the successfuly save 
        Session::flash('success', 'The blog post was successfully save!');

        // Redirect to another page
        return redirect() -> route('posts.show', $post -> id);
    }

    // SHOW POST
    public function show($id)
    {
        // Find the post
        $post = Post::join('users', 'posts.user_id', '=', 'users.id') -> find($id);

        //Comment::where('post_id', '=', $id) -> join('users', 'comments.user_id', '=', 'users.id');

        // Return data of the post
        return view('posts.show') -> withPost($post);
    }

    
    // EDIT POST
    public function edit($id)
    {
        // Find the post in the DB
        $post = Post::join('users', 'posts.user_id', '=', 'users.id') -> find($id);
        // Return the view - Pass the value of the field
        return view('posts.edit') -> withPost($post);
    }

    // UPDATE POST
    public function update(Request $request, $id)
    {
        // Validate the data
        $post = Post::find($id);
        
        $validatedData = $request -> validate([
            'title' => 'required|max:50',
            'body' => 'required',
        ]);

        // Save the data to the database
        $post = Post::find($id);

        $post -> title = $request -> input('title');
        $post -> body = $request -> input('body');

        $post -> save();

        // Set flash data with success message
        Session::flash('success', 'The blog post was successfully save!');

        // Redirect with flash data to posts.show
        return redirect() -> route('posts.show', $post -> id);
    }

    // DESTROY POST
    public function destroy($id)
    {
        $post = Post::find($id);

        $post -> delete();

        Session::flash('success', 'The post was successfully deleted.');

        return redirect() -> route('posts.index');
    }
}
