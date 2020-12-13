<?php

use Illuminate\Database\Seeder;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create 10 follow
        for ($i = 1; $i <= 10; $i++)
        {
            DB::table('follows') -> insert(array(
                'userFollower_id' => 1,
                'userFollowed_id' => $i,
                'follow_created_at' => now(),
            ));
        }
    }
}
