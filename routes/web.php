<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Routes ADMIN
Route::group(['middleware' => ['auth', 'web', 'admin']], function() {

    // Route POST
    Route::get('/posts', 'PostController@index')->name('posts.index');

    // Route COMMENT
    Route::get('/comments', 'CommentController@index')->name('comments.index');

    // Route USER
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::delete('/users/{id}', 'UserController@destroy')->name('users.destroy');

    // Route RESPOST
    Route::get('/reposts', 'RepostController@index')->name('reposts.index');

    // Route RESPOST
    Route::get('/likes', 'LikeController@index')->name('likes.index');

});

// Routes USERS
Route::group(['middleware' => ['auth', 'web']], function() {

    // Routes POSTS
    Route::get('/posts/create', 'PostController@create')->name('posts.create');
    Route::post('/posts', 'PostController@store')->name('posts.store');
    Route::delete('/posts/{post}', 'PostController@destroy')->name('posts.destroy');
    Route::put('/posts/{post}', 'PostController@update')->name('posts.update');
    Route::get('/posts/{post}', 'PostController@show')->name('posts.show');
    Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit');

    // Routes COMMENTS
    Route::post('/comments/{post_id}', ['uses' => 'CommentController@store', 'as' => 'comments.store'])->middleware('auth');
    Route::delete('/comments/{comment_id}', ['uses' => 'CommentController@destroy', 'as' => 'comments.destroy'])->middleware('auth');

    // Route USER
    Route::get('/users/{user_id}', 'UserController@show')->name('users.show');
    Route::get('/users/{user_id}/repost', 'UserController@showreposts')->name('users.showreposts');
    Route::get('/users/{user_id}/like', 'UserController@showlikes')->name('users.showlikes');

    Route::get('/users/{user_id}/follower', 'UserController@showfollower')->name('users.showfollower');
    Route::get('/users/{user_id}/followed', 'UserController@showfollowed')->name('users.showfollowed');

    // Route REPOST
    Route::post('/reposts/{post_id}', 'RepostController@store')->name('reposts.store');
    Route::delete('/reposts/{repost_id}', 'RepostController@destroy')->name('reposts.destroy');

    // Route LIKES
    Route::post('/likes/{post_id}', 'LikeController@store')->name('likes.store');
    Route::delete('/likes/{like_id}', 'LikeController@destroy')->name('likes.destroy');

    // Route FOLLOWS
    Route::post('/follows/{user_id}', 'FollowController@store')->name('follows.store');
    Route::delete('/follows/{follow_id}', 'FollowController@destroy')->name('follows.destroy');
});

// Routes ONLY USERS
Route::group(['middleware' => ['auth', 'web', 'user']], function() {

    // Route POSTS - (Only Users)
    Route::get('/home', 'HomeController@index')->name('home');

});
