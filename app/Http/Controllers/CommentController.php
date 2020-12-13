<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Obtain all comments of the all posts
        $comments = Comment::join('users', 'comments.comment_user_id', '=', 'users.id') -> join('posts', 'comments.comment_post_id', '=', 'posts.post_id') -> orderBy('comments.comment_id', 'desc') -> paginate(10);

        // Return to the view where display the comments
        return view('comments.index') -> withComments($comments);
    }

    // SAVE COMMENT
    public function store(Request $request, $post_id)
    {
        // Validate the data
        $validatedData = $request -> validate([
            'comment_title' => 'required|max:20',
            'comment_body' => 'required'
        ]);

        // Obtain the post
        $post = Post::where('post_id', '=', $post_id) -> first();

        // Save in the database
        $comment = new Comment;
        $comment -> comment_title = $request -> comment_title;
        $comment -> comment_body = $request -> comment_body;
        $comment -> comment_user_id = Auth::id(); // User id currently active
        $comment -> comment_post_id = $post_id;
        $comment -> comment_created_at = now();

        $comment -> save();

        // Show message of the successfuly save 
        Session::flash('success', 'The comment post was successfully save!');

        // Redirect to same page of the post
        return redirect() -> route('posts.show', $post_id);
    }

    // DELETE COMMENT
    public function destroy($comment_id)
    {
        // Find the comment on the DB - For
        $comment = Comment::where('comment_id', '=', $comment_id) -> first();

        // Delete the comment on the DB
        Comment::where('comment_id', '=', $comment_id) -> delete();

        // Send message to the view
        Session::flash('success', 'The comment was successfully deleted.');

        // Return to the view (post) where the comment was found
        return redirect() -> route('posts.show', $comment -> comment_post_id);
    }

}
