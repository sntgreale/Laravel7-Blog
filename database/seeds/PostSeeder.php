<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lorem = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

        // Create 3 posts for user
        for ($i = 1; $i <= 10; $i++)
        {
            for ($j = 1; $j <= 3; $j++)
            {
                DB::table('posts') -> insert(array(
                    'post_title' => "U " . $i . ' T Post ' . $j,
                    'post_body' => "Body Post " . $j . '. ' . $lorem,
                    'post_user_id' => $i,
                    'post_created_at' => now(),
                ));
            }
        }
    }
}
