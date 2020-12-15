<?php

use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 3 likes for user
        for ($i = 1; $i <= 10; $i++)
        {
            for ($j = 4; $j <= 7; $j++)
            {
                DB::table('likes') -> insert(array(
                    'like_user_id' => $i,
                    'like_post_id' => $j,
                    'like_created_at' => now(),
                ));
            }
        }
    }
}
