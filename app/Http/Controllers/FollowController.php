<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Follow;

use Session;

class FollowController extends Controller
{

    public function store($user_id)
    {
        if (Auth::id() != $user_id)
        {

            // Save in the database
            $follow = new Follow;
            $follow -> userFollower_id = Auth::id();
            $follow -> userFollowed_id = $user_id;
            $follow -> follow_created_at = now();
        
            $follow -> save();
        
            // Show message of the successfuly save 
            Session::flash('success', 'The follow was successfully save!');
        
            // Redirect to another page
            return redirect() -> route('users.show', $user_id);

        }
        // Redirect to another page
        return redirect() -> route('users.show', $user_id);
    }

    public function destroy($follow_id)
    {
        // Find the follow on the DB
        $follow = Follow::where('follow_id', '=', $follow_id) -> first();

        if ((Auth::user() -> id == $follow -> userFollower_id) or (Auth::user() -> is_admin == 1) )
        {
            // Delete the like on the DB
            Follow::where('follow_id', '=', $follow_id) -> delete();
        
            // Send message to the view
            Session::flash('success', 'The follow was successfully deleted.');
        
            // Return to the view (user)
            return redirect() -> route('users.show', $follow -> userFollowed_id );
        }
        
        // Return to the view (user)
        return redirect() -> route('users.show', $follow -> userFollowed_id );
    }
}
