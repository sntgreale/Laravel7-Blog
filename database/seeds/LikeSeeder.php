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
        for ($i = 1; $i <= 10; $i++)
        {
            DB::table('likes') -> insert(array(
                'like_user_id' => 1,
                'like_post_id' => $i,
                'like_created_at' => now(),
            ));
        }
    }
}
