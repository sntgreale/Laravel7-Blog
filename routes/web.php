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

Route::get('/home', 'HomeController@index')->name('home');

// Routes POSTS
Route::resource('posts', 'PostController');

// Routes COMMENTS
Route::get('/comments', 'CommentController@index')->name('comments.index');
Route::post('comments/{post_id}', ['uses' => 'CommentController@store', 'as' => 'comments.store']);
Route::delete('comments/{comment_id}', ['uses' => 'CommentController@destroy', 'as' => 'comments.destroy']);

// Routes REPOSTS
Route::resource('reposts', 'RepostController');

// Routes LIKES
Route::resource('likes', 'LikeController');

// Routes FOLLOWS
Route::resource('follows', 'FollowController');

// Routes USERS
Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/{user_id}', 'UserController@show')->name('users.show');