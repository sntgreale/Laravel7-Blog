<?php

use Illuminate\Database\Seeder;

class RepostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 3 reposts for user
        for ($i = 1; $i <= 10; $i++)
        {
            for ($j = 1; $j <= 3; $j++)
            {
                DB::table('reposts') -> insert(array(
                    'repost_user_id' => $i,
                    'repost_post_id' => $j,
                    'repost_created_at' => now(),
                ));
            }
        }
    }
}
