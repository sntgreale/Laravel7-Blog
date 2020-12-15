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

        // Create 3 follow for user
        for ($i = 1; $i <= 10; $i++)
        {
            for ($j = 1; $j <= 10; $j++)
            {
                DB::table('follows') -> insert(array(
                    'userFollower_id' => $i,
                    'userFollowed_id' => $j,
                    'follow_created_at' => now(),
                ));
            }
        }
    }
}
