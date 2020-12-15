<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\RePost;
use App\User;

use Session;

class RepostController extends Controller
{
    // GET ALL REPOSTS
    public function index()
    {
        // Find all RePosts
        $reposts = RePost::join('users', 'reposts.repost_user_id', '=', 'users.id') -> join('posts', 'reposts.repost_post_id', '=', 'posts.post_id') -> orderBy('reposts.repost_id' , 'desc') -> paginate(10);

        // Return all reposts to the view
        return view('reposts.index') -> withReposts($reposts);
    }

    // CREATE REPOST
    public function store($post_id)
    {
        // Save in the database
        $repost = new RePost;
        $repost -> repost_user_id = Auth::id();
        $repost -> repost_post_id = $post_id;
        $repost -> repost_created_at = now();
        
        $repost -> save();
        
        // Show message of the successfuly save 
        Session::flash('success', 'The repost was successfully save!');
        
        // Redirect to another page
        return redirect() -> route('posts.show', $post_id);
    }

    public function destroy($repost_id)
    {
        // Find the comment on the DB - For
        $repost = RePost::where('repost_id', '=', $repost_id) -> first();

        if ((Auth::user() -> id == $repost -> repost_user_id) or (Auth::user() -> is_admin == 1) )
        {
            // Delete the comment on the DB
            RePost::where('repost_id', '=', $repost_id) -> delete();
        
            // Send message to the view
            Session::flash('success', 'The repost was successfully deleted.');
        
            // Return to the view (post) where the comment was found
            return redirect() -> route('posts.show', $repost -> repost_post_id);
        }
        
        // Return to the view (post) where the comment was found
        return redirect() -> route('posts.show', $repost -> repost_post_id);
    }
}
