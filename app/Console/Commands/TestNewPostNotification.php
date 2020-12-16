<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Post;
use App\User;

use App\Notifications\SlackNoti;

class TestNewPostNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:slack';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Slack notification for new post registered.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Post::last() -> notify(new SlackNoti());
    }
}
