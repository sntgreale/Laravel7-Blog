<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lorem = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

        // Create 10 comments
        for ($i = 1; $i <= 10; $i++)
        {
            DB::table('comments') -> insert(array(
                'comment_title' => "Title Comment " . $i,
                'comment_body' => "Body Comment " . $i . '. ' . $lorem,
                'comment_user_id' => $i,
                'comment_post_id' => $i,
                'comment_created_at' => now(),
            ));
        }
    }
}
