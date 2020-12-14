<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Like;
use App\User;

use Session;

class LikeController extends Controller
{
    // GET ALL LIKES
    public function index()
    {
        // Find all Likes
        $likes = Like::join('users', 'likes.like_user_id', '=', 'users.id') -> join('posts', 'likes.like_post_id', '=', 'posts.post_id') -> orderBy('likes.like_id' , 'desc') -> paginate(10);
    
        // Return all likes to the view
        return view('likes.index') -> withLikes($likes);
    }

    // CREATE LIKE
    public function store($post_id)
    {
        // Save in the database
        $like = new Like;
        $like -> like_user_id = Auth::id();
        $like -> like_post_id = $post_id;
        $like -> like_created_at = now();
        
        $like -> save();
        
        // Show message of the successfuly save 
        Session::flash('success', 'The like was successfully save!');
        
        // Redirect to another page
        return redirect() -> route('posts.show', $post_id);
    }

    public function destroy($like_id)
    {
        // Find the comment on the DB - For
        $like = Like::where('like_id', '=', $like_id) -> first();

        if ((Auth::user() -> id == $like -> like_user_id) or (Auth::user() -> is_admin == 1) )
        {
            // Delete the like on the DB
            Like::where('like_id', '=', $like_id) -> delete();
        
            // Send message to the view
            Session::flash('success', 'The like was successfully deleted.');
        
            // Return to the view (post) where the comment was found
            return redirect() -> route('posts.show', $like -> like_post_id);
        }
        
        // Return to the view (post) where the comment was found
        return redirect() -> route('posts.show', $like -> like_post_id);
    }
}
