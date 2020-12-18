<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable; // Slack Noti

use App\Notifications\SlackNoti; // Slack Noti

use App\User;
use App\Comment;
use App\RePost;
use App\Like;

class Post extends Model {

    use Notifiable;

    protected static function boot()
    {
        parent::boot();

        self::created(function($model)
        {
            $model->notify(new SlackNoti());
        });
    }

    //
    protected $table = "posts";
    public $timestamps = false;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reposts()
    {
        return $this->hasMany(RePost::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Send notification on Slack
    public function routeNotificationForSlack($notification)
    {
        return env('SLACK_NOTIFICATION_WEBHOOK');
    }
}