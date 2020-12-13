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
        for ($i = 1; $i <= 10; $i++)
        {
            DB::table('reposts') -> insert(array(
                'repost_user_id' => 1,
                'repost_post_id' => $i,
                'repost_created_at' => now(),
            ));
        }
    }
}
