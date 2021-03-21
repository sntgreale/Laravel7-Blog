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

    //
    public function userX($id)
    {
        // Select X users of the DB. With statistics
        $userx = User::select('name', 'email', 'created_at') -> where('id', '=', $id) -> first();

        $userPosts = Post::where('post_user_id', '=', $id) -> count();

        $userReposts = RePost::where('repost_user_id', '=', $id) -> count();

        $userLikes = Like::where('like_user_id', '=', $id) -> count();

        $userFollower = Follow::where('userFollowed_id', '=', $id) -> join('users', 'users.id', '=', 'follows.userFollower_id') -> select('name', 'email') -> get();

        $userFollowed = Follow::where('userFollower_id', '=', $id) -> join('users', 'users.id', '=', 'follows.userFollowed_id') -> select('name', 'email') -> get();

        $data = [];
        $data['User'] = $userx;
        $data['Posts'] = $userPosts;
        $data['Reposts'] = $userReposts;
        $data['Likes'] = $userLikes;
        $data['Followers'] = $userFollower;
        $data['Followed'] = $userFollowed;

        return ($data);
    }


    public function posts()
    {
        // Select all posts on the DB.
        $posts = Post::select('post_title', 'post_body', 'post_created_at') -> get(); 

        $posts = strip_tags($posts);

        return($posts);
    }

    public function postsComp()
    {
        // Select all posts on the DB.
        $posts = Post::select('post_title', 'post_body', 'post_created_at') -> get(); 
        
        return($posts);
    }

    public function postX($id)
    {
        // Select X posts on the DB. With statistics
        $postX = Post::select('post_title', 'post_body', 'post_created_at') -> where('post_id', '=', $id) -> get(); 

        $postReturn[0]["post_title"] = $postX[0]['post_title'];
        $postReturn[0]["post_body"] = strip_tags($postX[0]['post_body']);
        $postReturn[0]["post_created_at"] = $postX[0]['post_created_at'];

        $comments = Comment::where('comment_post_id', '=', $id) -> select('comment_title', 'comment_body', 'comment_created_at') -> get();
        $commentsReturn[0]["quantity"] = $comments -> count() ;
        $commentsReturn[0]["comments"] = $comments;

        $userRepost = RePost::where('repost_post_id', '=', $id) -> join('users', 'users.id', '=', 'reposts.repost_user_id') -> select('name', 'email') -> get();
        $userRepostReturn[0]["quantity"] = $userRepost -> count();
        $userRepostReturn[0]["users"] = $userRepost;

        $userLike = Like::where('like_post_id', '=', $id) -> join('users', 'users.id', '=', 'likes.like_user_id') -> select('name', 'email') -> get();
        $userLikeReturn[0]["quantity"] = $userLike -> count();
        $userLikeReturn[0]["users"] = $userLike;

        $data = [];
        $data['Post'] = $postReturn;
        $data['Comments'] = $commentsReturn;
        $data['Reposts'] = $userRepostReturn;
        $data['Likes'] = $userLikeReturn;

        return($data);
    }

    public function postXComp($id)
    {
        // Select X posts on the DB. With statistics
        $postX = Post::select('post_title', 'post_body', 'post_created_at') -> where('post_id', '=', $id) -> get(); 

        $comments = Comment::where('comment_post_id', '=', $id) -> select('comment_title', 'comment_body', 'comment_created_at') -> get();
        $commentsReturn[0]["quantity"] = $comments -> count() ;
        $commentsReturn[0]["comments"] = $comments;

        $userRepost = RePost::where('repost_post_id', '=', $id) -> join('users', 'users.id', '=', 'reposts.repost_user_id') -> select('name', 'email') -> get();
        $userRepostReturn[0]["quantity"] = $userRepost -> count();
        $userRepostReturn[0]["users"] = $userRepost;

        $userLike = Like::where('like_post_id', '=', $id) -> join('users', 'users.id', '=', 'likes.like_user_id') -> select('name', 'email') -> get();
        $userLikeReturn[0]["quantity"] = $userLike -> count();
        $userLikeReturn[0]["users"] = $userLike;

        $data = [];
        $data['Post'] = $postX;
        $data['Comments'] = $commentsReturn;
        $data['Reposts'] = $userRepostReturn;
        $data['Likes'] = $userLikeReturn;

        return($data);
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
